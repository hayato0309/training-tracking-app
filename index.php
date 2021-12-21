<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Tracking App</title>
    <!-- Google fonts - Raleway -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <!-- CSS files -->
    <link rel="stylesheet" href="css/destyle.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="wrapper">
        <div class="wrapper-left">
            <section class="daily-announce component">
                <div class="day">December 20th 2021</div>
                <div class="greeting">Hello Hayato!</div>
                <div class="reminder">Today is <span class="training-type">Leg</span> day. Keep it up!</div>
            </section>
            <section class="streak component">
                <div class="streak-days">Day 32</div>
            </section>
            <section class="schedule component" id="open-schedule-modal">
                <h2 class="heading">Schedule</h2>
                <ul>
                    <li>
                        <div class="day">MON</div>
                        <div class="training-type">Chest</div>
                    </li>
                    <li>
                        <div class="day">TUE</div>
                        <div class="training-type">Shoulder</div>
                    </li>
                    <li>
                        <div class="day">WED</div>
                        <div class="training-type">Rest</div>
                    </li>
                    <li>
                        <div class="day">THU</div>
                        <div class="training-type">Arms</div>
                    </li>
                    <li>
                        <div class="day">FRI</div>
                        <div class="training-type">Legs</div>
                    </li>
                    <li>
                        <div class="day">SAT</div>
                        <div class="training-type">Rest</div>
                    </li>
                    <li>
                        <div class="day">SUN</div>
                        <div class="training-type">Rest</div>
                    </li>
                </ul>
            </section>
            <div class="modal-container" id="schedule-modal-container">
                <div class="modal" id="schedule-modal">
                    <div class="modal-header">
                        <div class="modal-title">
                            Training Schedule
                        </div>
                        <button data-close-button class="close-button" id="close-schedule-modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, deserunt vel? Voluptatibus natus libero soluta numquam neque quaerat perferendis dolore in assumenda alias id reiciendis quasi facilis ullam ab cupiditate veniam impedit magnam totam, qui veritatis? Odio dolor et maiores nam rerum nulla molestiae soluta, accusantium quod fuga harum! Quisquam!
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-right">
            <section class="sizes component" id="open-sizes-modal">
                <h2 class="heading">Sizes</h2>
                <table>
                    <tr>
                        <th></th>
                        <th>Start</th>
                        <th>Current</th>
                        <th>Goal</th>
                        <th>Diff</th>
                    </tr>
                    <tr>
                        <td>Height</td>
                        <td>165 cm</td>
                        <td>165 cm</td>
                        <td>165 cm</td>
                        <td>+0 cm</td>
                    </tr>
                    <tr>
                        <td>Weight</td>
                        <td>57 kg</td>
                        <td>57 kg</td>
                        <td>65 kg</td>
                        <td>+8 kg</td>
                    </tr>
                    <tr>
                        <td>Chest</td>
                        <td>97 cm</td>
                        <td>97 cm</td>
                        <td>105 cm</td>
                        <td>+8 cm</td>
                    </tr>
                    <tr>
                        <td>Waist</td>
                        <td>70 cm</td>
                        <td>70 cm</td>
                        <td>70 cm</td>
                        <td>+0 cm</td>
                    </tr>
                    <tr>
                        <td>Biceps</td>
                        <td>35 cm</td>
                        <td>35 cm</td>
                        <td>40 cm</td>
                        <td>+5 cm</td>
                    </tr>
                    <tr>
                        <td>Hip</td>
                        <td>80 cm</td>
                        <td>80 cm</td>
                        <td>85 cm</td>
                        <td>+5 cm</td>
                    </tr>
                    <tr>
                        <td>Thigh</td>
                        <td>40cm</td>
                        <td>40cm</td>
                        <td>45cm</td>
                        <td>+5 cm</td>
                    </tr>
                </table>
            </section>
            <div class="modal-container" id="sizes-modal-container">
                <div class="modal" id="sizes-modal">
                    <div class="modal-header">
                        <div class="modal-title">
                            Sizes
                        </div>
                        <button data-close-button class="close-button" id="close-sizes-modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, deserunt vel? Voluptatibus natus libero soluta numquam neque quaerat perferendis dolore in assumenda alias id reiciendis quasi facilis ullam ab cupiditate veniam impedit magnam totam, qui veritatis? Odio dolor et maiores nam rerum nulla molestiae soluta, accusantium quod fuga harum! Quisquam!
                    </div>
                </div>
            </div>
            <section class="cost component" id="open-cost-modal">
                <h2 class="heading">Cost</h2>
                <div class="monthly">
                    <div>November, 2021</div>
                    <div>¥10,000-</div>
                </div>
                <div class="totalCost">
                    <div>From 2021-09-01 until today</div>
                    <div>¥50,000-</div>
                </div>
            </section>
            <div class="modal-container" id="cost-modal-container">
                <div class="modal" id="cost-modal">
                    <div class="modal-header">
                        <div class="modal-title">
                            Cost
                        </div>
                        <button data-close-button class="close-button" id="close-cost-modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, deserunt vel? Voluptatibus natus libero soluta numquam neque quaerat perferendis dolore in assumenda alias id reiciendis quasi facilis ullam ab cupiditate veniam impedit magnam totam, qui veritatis? Odio dolor et maiores nam rerum nulla molestiae soluta, accusantium quod fuga harum! Quisquam!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>