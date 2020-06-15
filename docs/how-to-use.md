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
To test our api endpoints, we'll use tools like **postman**(https://www.postman.com/downloads/) or **insomnia**(https://insomnia.rest/download/)

#### Students
=========

* ##### get students
    **description:** Retrieve all registered students
    **path:** http://localhost:8000/api/students
    **method:** GET
    **body:** {}

* ##### post students
    **description:** Allow to create a new student
    **path:** http://localhost:8000/api/students
    **method:** POST
    **body:** {
        'lastname' : 'hugo',
        'firstname': 'valentin',
        'birthdate': '2008-08-04'
    }

* ##### get student
    **description:** get a particular student
    **path:** http://localhost:8000/api/students/{id}
    **method:** GET
    **body:** {}

* ##### delete student
    **description:** delete all informations about a particular student
    **path:** http://localhost:8000/api/students/{id}
    **method:** DELETE
    **body:** {}


* ##### modify student
    **description:** update informations about a particular student
    **path:** http://localhost:8000/api/students/{id}
    **method:** PUT
    **body:** {
        'birthdate': '2005-07-14'
    }

#### Notes
======

* ##### get students
    **description:** Collect all notes from all students
    **path:** http://localhost:8000/api/notes
    **method:** GET
    **body:** {}

* ##### post notes
    **description:** add a new note to a single student
    **path:** http://localhost:8000/api/notes
    **method:** POST
    **body:** {
        'value': 18,
        'course': 'politics',
        'student': '/api/students/{id}
    }

* ##### get note
    **description:** get a note, the course and the associated student
    **path:** http://localhost:8000/api/notes/{id}
    **method:** GET
    **body:** {}

* ##### delete note
    **description:** delete a note associated to a student
    **path:** http://localhost:8000/api/students/{id}
    **method:** DELETE
    **body:** {}

* ##### modify note
    **description:** update note about a particular student
    **path:** http://localhost:8000/api/notes/{id}
    **method:** PUT
    **body:** {
        'value': 17.5
    }

#### Average
======

* ##### get averages
    **description:** get the general average from all students
    **path:** http://localhost:8000/api/students/average
    **method:** GET
    **body:** {}

* ##### get average
    **description:** get the general average from single student
    **path:** http://localhost:8000/api/students/{id}/average
    **method:** GET
    **body:** {}

* ##### get the general average of the class
    **description:** get the general average from all students
    **path:** http://localhost:8000/api/students/average-general
    **method:** GET
    **body:** {}