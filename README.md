# ATIWD2 Assignment
By Deane Sales 

# Learning Goals & Outcomes 
- Learn to model, clense & normalize substantial real-world big data (188 mb+);
- Understand the data cleansing and normalization processes by writing PHP scripts to process and convert the data to first (cleansed) CSV and then (normalized) XML;
- Gain knowledge and skill in the design, implementation & visualisation of data using web based charting and mapping API's.
- Fulfil the submission requirement of providing the two conversion scipts for benchmarking and one XSD schema file for validation purposes.
- Extend your skills in the use use of key technologies: PHP, XML & XPATH, Parsing, DOM, JavaScript & JSON.
- Learn and use the MARKDOWN  markup syntax.

# Task 1: Cleanse and Refactor the Data (20 marks)
Write a PHP script (extract-to-csv.php) to process the input file (air-quality-data-2004-2019.csv) and output 18 smaller csv files holding data for each monitoring station.

# Task 2: Data Transformation, Normalisation & XML Validation (20 marks)
2a. Write a PHP script - normalize-to-xml.php to transform each data CSV file to the following example XML structure (12 marks):

2b. Design and write a XSD 1.1 Schema file to validate the data XML files.(8 marks):


# Task 3: Charts Visualisation (20 marks)
A scatter chart to show a years worth of data (averaged by month) from a specific station for Carbon Monoxide (NO) at a certain time of day - say 08.00 hours.

A line chart showing levels in any 24 hour period on any day (user selectable) for any of the six stations (user selectable) for any of the major pollutants (nox, no, no2) in the date range downloaded.

# Task 4: Maps Visualisation (20 marks)
Use Google Maps or any other mapping API to visualise the data:

# Task 5: Reflection & Report (20 marks)
A report in Markdown format to include:

A discussion of parsing methods and tools and when to use streaming parsers over DOM parsers for document processing (up to 600 words) (8 marks);

Links to all code and data files for examination and marking (8 marks);

How you might go about refactoring and extending the charting and data visualisation functionality you have implemented.(4 marks)
