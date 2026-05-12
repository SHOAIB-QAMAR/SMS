<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_header.php") ?>

<!-- Sidebar -->
<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_sidebar.php") ?>
<input type="hidden" value="3" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_navbar.php"); ?>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Examination</h1>
                <ul class="breadcrumb">
                    <li><a>Exam Results & Progress</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bxs-graduation'></i>
                    <h3>Exam Results</h3>
                </div>
                <div class="d-flex mb-3">
                    <input id="gfg" class="form-control" type="text"
                        placeholder="Search for Title, Date, Subjects or Grade..." style="max-width: 400px;">
                </div>
                <table id="allResultList">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Subject</th>
                            <th>Title</th>
                            <th>Obtain Marks</th>
                            <th>Total Marks</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="geeks">
                        <?php
                        $id = $_SESSION['uid'];
                        $query2 = "SELECT `exam_id`, MAX(`s_no`) as latest FROM `marks` WHERE `student_id` = ? GROUP BY `exam_id` ORDER BY latest DESC LIMIT 50";
                        $stmt2 = $conn->prepare($query2);
                        $stmt2->bind_param("s", $id);
                        $stmt2->execute();
                        $result2 = $stmt2->get_result();

                        if ($result2->num_rows > 0) {
                            while ($row2 = $result2->fetch_assoc()) {
                                $examId = $row2['exam_id'];
                                $query3 = "SELECT * FROM `exams` WHERE `exam_id` = ?";
                                $stmt3 = $conn->prepare($query3);
                                $stmt3->bind_param("s", $examId);
                                $stmt3->execute();
                                $result3 = $stmt3->get_result();
                                $row3 = $result3->fetch_assoc();

                                $formattedDate = date("d-m-Y", strtotime($row3['timestamp']));

                                if ($row3['subject'] == "ALL") {
                                    $sql = "SELECT * FROM `marks` WHERE `exam_id` = ? AND `student_id` = ?";
                                    $stmt4 = $conn->prepare($sql);
                                    $stmt4->bind_param("ss", $row3['exam_id'], $id);
                                    $stmt4->execute();
                                    $marksResult = $stmt4->get_result();

                                    $totalGainMarks = 0;
                                    $subjectCount = 0;
                                    $isFail = false;
                                    while ($tempRow = $marksResult->fetch_assoc()) {
                                        $totalGainMarks += (int) $tempRow['marks'];
                                        $subjectCount++;
                                        if ((int) $tempRow['marks'] < (int) $row3['passing_marks'])
                                            $isFail = true;
                                    }
                                    $status = $isFail ? "Fail" : "Pass";
                                    echo "<tr>
                                            <td>$formattedDate</td>
                                            <td><a class='text-primary' style='cursor:pointer;' onClick='handleShowAllSubjectMarks(`" . $row3['exam_id'] . "`)'>" . $row3['subject'] . "</a></td>
                                            <td>" . $row3['exam_title'] . "</td>
                                            <td>$totalGainMarks</td>
                                            <td>" . ($subjectCount * $row3['total_marks']) . "</td>
                                            <td>$status</td>
                                        </tr>";
                                } else {
                                    $sql = "SELECT * FROM `marks` WHERE `exam_id` = ? AND `student_id` = ? AND `subject`=? LIMIT 1";
                                    $stmt4 = $conn->prepare($sql);
                                    $stmt4->bind_param("sss", $row3['exam_id'], $id, $row3['subject']);
                                    $stmt4->execute();
                                    $marksResult = $stmt4->get_result();
                                    $marksResultRow = $marksResult->fetch_assoc();
                                    $mark = $marksResultRow['marks'] ?? 0;

                                    $status = ((int) $mark >= (int) $row3['passing_marks']) ? "Pass" : "Fail";
                                    echo "<tr>
                                            <td>$formattedDate</td> 
                                            <td>" . $row3['subject'] . "</td>
                                            <td>" . $row3['exam_title'] . "</td>
                                            <td>$mark</td>
                                            <td>" . $row3['total_marks'] . "</td>
                                            <td>$status</td>
                                        </tr>";
                                }
                                $stmt3->close();
                                if (isset($stmt4))
                                    $stmt4->close();
                            }
                        } else {
                            echo '<tr><td colspan="6" class="text-center">No Data found</td></tr>';
                        }
                        $stmt2->close();
                        ?>
                    </tbody>
                </table>
            </div>

        </div>

        <style>
            .badge-pass {
                background-color: #d1e7dd;
                color: #0f5132;
                border: 1px solid #badbcc;
                padding: 5px 12px;
                border-radius: 50px;
                font-size: 0.75rem;
                font-weight: 600;
            }
            .badge-fail {
                background-color: #f8d7da;
                color: #842029;
                border: 1px solid #f5c2c7;
                padding: 5px 12px;
                border-radius: 50px;
                font-size: 0.75rem;
                font-weight: 600;
            }
            #subjectiveResultTable .orders {
                border-radius: 15px;
                box-shadow: var(--shadow-md);
                border: 1px solid rgba(0,0,0,0.05);
                overflow: hidden;
            }
            .result-header-custom {
                background: linear-gradient(45deg, #1d7431, #145a24);
                color: white !important;
                padding: 15px 20px !important;
            }
            .result-header-custom i, .result-header-custom h3 {
                color: white !important;
            }
        </style>

        <div id="subjectiveResultTable" class="mt-4" style="display: none;">
            <!-- Detailed marks table will appear here via JS -->
        </div>
        </div>
    </main>
</div>

<script>
    $(document).ready(function () {
        $("#gfg").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#geeks tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function handleShowAllSubjectMarks(examId) {
        const resultTable = document.getElementById('subjectiveResultTable');
        resultTable.style.display = "block";
        resultTable.innerHTML = `
            <div class="orders">
                <div class="header d-flex justify-content-center align-items-center p-5">
                    <div class="spinner-border text-primary me-2" role="status"></div>
                    <span class="fw-bold">Fetching Detailed Results...</span>
                </div>
            </div>`;
        
        fetch('../assets/fetchSubjectiveResults.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'exam_id=' + encodeURIComponent(examId)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                // Update the data to use our custom badges
                let enhancedData = data.data
                    .replace(/bg-success-subtle text-success border border-success-subtle/g, 'badge-pass')
                    .replace(/bg-danger-subtle text-danger border border-danger-subtle/g, 'badge-fail')
                    .replace(/badge /g, '');

                resultTable.innerHTML = `
                    <div class="orders animate__animated animate__fadeIn">
                        <div class="header result-header-custom d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class='bx bxs-pie-chart-alt-2 me-2'></i>
                                <h3 class="mb-0">Performance Breakdown</h3>
                            </div>
                            <button class="btn btn-sm btn-outline-light border-0" onclick="closeDetailedResults()">
                                <i class='bx bx-x fs-4'></i>
                            </button>
                        </div>
                        ${enhancedData}
                    </div>`;
                
                // Scroll to the results
                setTimeout(() => {
                    resultTable.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 100);
            } else {
                resultTable.innerHTML = '<div class="alert alert-danger m-3">' + data.message + '</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            resultTable.innerHTML = '<div class="alert alert-danger m-3">Failed to fetch exam details. Please try again.</div>';
        });
    }

    function closeDetailedResults() {
        document.getElementById('subjectiveResultTable').style.display = "none";
    }
</script>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_footer.php"); ?>
<script src="app.js"></script>