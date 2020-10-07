# PHP rest api
This repo is a solution to an assignment in the course Webbutveckling III at MIUN.
***

All calls are made to
``` 
http://amhax.se/mom5/api
```
And are returned as JSON.

Methods that are available:
``` 
GET - fetches some json containing information about courses stored in the database
POST - add a course to the databse, needs to have some information in the request body in json-format in this format:
{
	code: 'DT003G',
	name: 'Databaser',
	prog: 'A',
	syllabus: 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=21595'
}
PUT - updates a course in the database, based on the request body, formatted in the same way as above.
DELETE - deletes a course in the database, based on the code-value in the data specified above.
```