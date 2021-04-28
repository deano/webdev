
Github: https://github.com/deano/webdev/tree/main/ATIWD2%20-%20Assignment

# Task 5: Reflection & Report
In this task, I will be dicussing the parsing methods and tools and when to use streaming parsers over DOM parsers for document processing. 


----------


## Parsing Methods & Tools
**Two main types of parsing:**
1. Document Object Model oriented parsers
2.  Stream Oriented Parsers


### DOM Oriented Parser
Document Object Model oriented parsers also known as: **"DOM"** is an API for HTML and XML documents. It requires you to load the entire XML document into memory, but they provide an object-oriented tree of the XML nodes. DOM parsers are fast, however, they take up a considerable amount of memory compared to streams due to the requirement of storing the whole DOM tree in memory.

w3c specification notes that one important objective for the DOM is to provide a standard programming interface which can be used in a wide variety of environments, also applications.

### Stream Parsers
There are 2 different types of Stream Oriented Parsers: **push and pull**

1. Simple API for XML, also known as: **"SAX"** is a push parsing method. 
2. Streaming API for XML, also known as **"StAX"** is a pull parsing method.

### SAX
SAX parser which is often referred to as “push parsing” is a simpler and faster interface than the Document Object Model (DOM), SAX pushes the lower-level event at the application. SAX does not allow backtracking, which means previous data that was accessed cannot be re-read. When collecting the information from the document, it is collected as a single stream – this consumes less memory. SAX can fetch a small subset of information from a large document, also able to ignore unnecessary data. It’s main benefit is efficiency.
### StAX
StAX parser is referred to as the “pull parsing”. StAX allows users to read and write XML as efficiently as possible and is considered to be better for parsing streaming XML. The application is in total control. StAX libraries are also much smaller, the client code which interacts with its libraries is much simpler. A StAX is also able to filter XML documents, for example, elements that are unnecessary can be ignored.


----------


## Visualisation

In task 3 & 4, the charts and map visualisation requires reading and processing of the data from all 18 XML files that were produced with “normalize-to-xml.php”

## Charts

### Scatter Chart
The below image is a screenshot of the scatter chart.
- Drop down list to select Year.
- Drop down list to select Station.
- Spinner to select hour from 0-23.
![../../../../../../../Applications/XAMPP/xamppfiles/htdocs/ATIWD2%20-%20Assignment/Images/Scatter%20Chart.png](../../../../../../../Applications/XAMPP/xamppfiles/htdocs/ATIWD2%20-%20Assignment/Images/Scatter%20Chart.png)
### Line Chart
- User can select 6 stations by holding CTRL or CMD depending on the OS.
- Drop down list to select pollutant from: NO, NOX, NO2.
- Date in (DD/MM/YYYY) format using HTML date.

![../../../../../../../Applications/XAMPP/Images/Line%20Chart.png](../../../../../../../Applications/XAMPP/Images/Line%20Chart.png)


## Maps	
- Clicking on marker shows the values of the monthly average for the station
- User can choose year and pollutant form the drop down list
![../../../../../../../Applications/XAMPP/xamppfiles/htdocs/ATIWD2%20-%20Assignment/Images/Maps.png](../../../../../../../Applications/XAMPP/xamppfiles/htdocs/ATIWD2%20-%20Assignment/Images/Maps.png)
## Further Improvements
For further improvements I could have created a web page, which has a navigation bar allowing you to navigate around and see the work produced, the charts and maps. For example, a drop down tab on the navigation bar listing the Charts would allow you to choose which to view: Line & Scatter charts. To do so, I would have to render the charts and maps into HTML files.
