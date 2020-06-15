## 3. How to use:

The environment is ready and all containers are started.
The project is accessible via the url **http://localhost:8000/**

The first page is blank, yeah this page is useless at the moment,
but go to **http://localhost:8000/api** to view the open api documentation.

#### rest api endpoints
```bash
$ docker-compose exec php php bin/console debug:router --env=prod

  Name                                               Method   Scheme   Host  Path                                 
 -------------------------------------------------- -------- -------- ------ ------------------------------------- 
  api_entrypoint                                     ANY      ANY      ANY    /api/{index}.{_format}               
  api_doc                                            ANY      ANY      ANY    /api/docs.{_format}                  
  api_jsonld_context                                 ANY      ANY      ANY    /api/contexts/{shortName}.{_format}  
  api_notes_get_collection                           GET      ANY      ANY    /api/notes.{_format}                 
  api_notes_post_collection                          POST     ANY      ANY    /api/notes.{_format}                 
  api_notes_get_item                                 GET      ANY      ANY    /api/notes/{id}.{_format}            
  api_notes_delete_item                              DELETE   ANY      ANY    /api/notes/{id}.{_format}            
  api_notes_put_item                                 PUT      ANY      ANY    /api/notes/{id}.{_format}            
  api_notes_patch_item                               PATCH    ANY      ANY    /api/notes/{id}.{_format}            
  api_students_get_collection                        GET      ANY      ANY    /api/students.{_format}              
  api_students_post_collection                       POST     ANY      ANY    /api/students.{_format}              
  api_students_students_average_collection           GET      ANY      ANY    /api/students/average                
  api_students_students_average_general_collection   GET      ANY      ANY    /api/students/average-general        
  api_students_get_item                              GET      ANY      ANY    /api/students/{id}.{_format}         
  api_students_delete_item                           DELETE   ANY      ANY    /api/students/{id}.{_format}         
  api_students_put_item                              PUT      ANY      ANY    /api/students/{id}.{_format}         
  api_students_student_average_item                  GET      ANY      ANY    /api/students/{id}/average  
```

#### Test API
To test our api endpoints, we'll use tools like <br /> **postman**(https://www.postman.com/downloads/) <br />or <br />**insomnia**(https://insomnia.rest/download/)

#### Students
=========

* ##### get students
    **description:** Retrieve all registered students<br />**path:** http://localhost:8000/api/students<br />**method:** GET<br />**body:** {}

* ##### post students
    **description:** Allow to create a new student<br />**path:** http://localhost:8000/api/students<br />**method:** POST<br />**body:** {<br />&nbsp;&nbsp;&nbsp;&nbsp;'lastname' : 'hugo',<br />&nbsp;&nbsp;&nbsp;&nbsp;'firstname': 'valentin',<br />&nbsp;&nbsp;&nbsp;&nbsp;'birthdate': '2008-08-04'<br />}

* ##### get student
    **description:** get a particular student<br /> **path:** http://localhost:8000/api/students/{id}<br /> **method:** GET<br /> **body:** {}

* ##### delete student
    **description:** delete all informations about a particular student<br />**path:** http://localhost:8000/api/students/{id}<br />**method:** DELETE<br />**body:** {}


* ##### modify student
    **description:** update informations about a particular student<br />**path:** http://localhost:8000/api/students/{id}<br />**method:** PUT<br />**body:** {<br />&nbsp;&nbsp;&nbsp;&nbsp;'birthdate': '2005-07-14'<br />}

#### Notes
======

* ##### get students
    **description:** Collect all notes from all students<br />**path:** http://localhost:8000/api/notes<br />**method:** GET<br />**body:** {}

* ##### post notes
    **description:** add a new note to a single student<br />**path:** http://localhost:8000/api/notes<br />**method:** POST<br />**body:** {<br />&nbsp;&nbsp;&nbsp;&nbsp;'value': 18,<br />&nbsp;&nbsp;&nbsp;&nbsp;'course': 'politics',<br />&nbsp;&nbsp;&nbsp;&nbsp;'student': '/api/students/{id}<br />}

* ##### get note
    **description:** get a note, the course and the associated student<br />**path:** http://localhost:8000/api/notes/{id}<br />**method:** GET<br />**body:** {}

* ##### delete note
    **description:** delete a note associated to a student<br />**path:** http://localhost:8000/api/students/{id}<br />**method:** DELETE<br />**body:** {}

* ##### modify note
    **description:** update note about a particular student<br />**path:** http://localhost:8000/api/notes/{id}<br />**method:** PUT<br />**body:** {<br />&nbsp;&nbsp;&nbsp;&nbsp;'value': 17.5<br />}

#### Average
======

* ##### get averages
    **description:** get the general average from all students<br />**path:** http://localhost:8000/api/students/average<br />**method:** GET<br />**body:** {}

* ##### get average
    **description:** get the general average from single student<br />**path:** http://localhost:8000/api/students/{id}/average<br />**method:** GET<br />**body:** {}

* ##### get the general average of the class
    **description:** get the general average from all students<br />**path:** http://localhost:8000/api/students/average-general<br />**method:** GET<br />**body:** {}