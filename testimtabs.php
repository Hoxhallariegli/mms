<!DOCTYPE html>
<html>
<head>
    <title>Tabbed Interface</title>
    <style>
        .tab-content {
            display: none;
        }
    </style>
    <script>
        function openTab(tabName) {
            var i, tabContent;
            tabContent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabContent.length; i++) {
                tabContent[i].style.display = "none";
            }
            document.getElementById(tabName).style.display = "block";
        }

        function submitForm(tabName) {
            // Perform form submission logic here

            // Hide the tab after form submission
            document.getElementById(tabName).style.display = "none";
        }
    </script>
</head>
<body>
<ul class="tabs">
    <li><a href="#" onclick="openTab('tab1')">Tab 1</a></li>
    <li><a href="#" onclick="openTab('tab2')">Tab 2</a></li>
    <li><a href="#" onclick="openTab('tab3')">Tab 3</a></li>
</ul>

<div class="tab-content" id="tab1">
    <h2>Tab 1 Content</h2>
    <form onsubmit="submitForm('tab1')">
        <!-- Your form fields and submit button here -->
        <input type="submit" value="Submit">
    </form>
</div>

<div class="tab-content" id="tab2">
    <h2>Tab 2 Content</h2>
    <form onsubmit="submitForm('tab2')">
        <!-- Your form fields and submit button here -->
        <input type="submit" value="Submit">
    </form>
</div>

<div class="tab-content" id="tab3">
    <h2>Tab 3 Content</h2>
    <form onsubmit="submitForm('tab3')">
        <!-- Your form fields and submit button here -->
        <input type="submit" value="Submit">
    </form>
</div>

<script>
    // Open the first tab by default
    openTab('tab1');
</script>
</body>
</html>
In this example, the submitForm() function is called when a form is submitted inside a tab. You can include your form submission logic within this function. After the form is submitted, it hides the corresponding tab by changing its display property to "none".

Note that this example assumes you are using a regular form submission. If you are using AJAX to submit the form asynchronously, you may need to handle the hiding of the tab differently based on the AJAX response.






