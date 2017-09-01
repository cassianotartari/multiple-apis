# Course Provisioning APIs

## Source API

This API provides read-only access to course information.

### Data Structures

<a name="Course"></a>
#### Course

A single course. It is represented as a JSON object with the following properties:

 Property | Type           | Description
----------|----------------|-------------------------------
 `id`     | String         | The course's unique ID number
 `name`   | String         | The course's name
 `grade`  | [GradeLevel][] | The course's grade level

<a name="GradeLevel"></a>
#### Grade Level

A grade level for a course. It is represented as a JSON string with one of the following values:

* `FR` -- Freshmen level (9th grade)
* `SPH` -- Sophomore level (10th grade)
* `JR` -- Junior level (11th grade)
* `SR` -- Senior level (12th grade)

### Endpoints

#### Course List

`GET /courses`

Returns all courses in a paginated list. The result is a JSON document with the following properties:

 Property | Required? | Description
----------|-----------|--------------------------------------
 `next`   | Optional  | URL for the next page of courses
 `prev`   | Optional  | URL for the previous page of courses
 `data`   | Required  | List of Course IDs

### Individual Course

`GET /courses/:course-id`

Returns a single [Course][] object.

## Destination API

This API provides a way to create new courses inside a given school.

### Data Structures

<a name="DstCourse"></a>
#### Course

A single course. It is represented as a JSON object with the following properties:

 Property | Type    | Description
----------|---------|-----------------------------------
 `title`  | String  | The course's name
 `grade`  | Integer | The course's grade level
 `srcid`  | String  | The course's ID in the Source API

### Endpoints

#### Course List

`POST /school/:school-id/courses`

Used to create one or more new courses in the specified school. Accepts a JSON document with the following properties:

 Property  | Required? | Description
-----------|-----------|--------------------------------------
 `courses` | Required  | List of [Course][DstCourse] objects

<!-- Links -->
[Course]: #Course
[DstCourse]: #DstCourse
[GradeLevel]: #GradeLevel