<?php
class Grade
{
    private $id;
    private $student_id;
    private $student_code;
    private $name;
    private $class_name;
    private $subject_id;
    private $subject_code;
    private $subject_name;
    private $score;

    public function __construct($id, $student_id, $subject_id, $score, $student_code = null, $name = null, $class_name = null, $subject_name = null, $subject_code = null)
    {
        $this->id = $id;
        $this->student_id = $student_id;
        $this->student_code = $student_code;
        $this->name = $name;
        $this->class_name = $class_name;
        $this->subject_id = $subject_id;
        $this->subject_name = $subject_name;
        $this->subject_code = $subject_code;
        $this->score = $score;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getStudentId()
    {
        return $this->student_id;
    }
    public function getStudentCode()
    {
        return $this->student_code;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getClassName()
    {
        return $this->class_name;
    }
    public function getSubjectId()
    {
        return $this->subject_id;
    }
    public function getSubjectCode()
    {
        return $this->subject_code;
    }
    public function getSubjectName()
    {
        return $this->subject_name;
    }
    public function getScore()
    {
        return $this->score;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setStudentId($student_id)
    {
        $this->student_id = $student_id;
    }
    public function setStudentCode($student_code)
    {
        $this->student_code = $student_code;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setClassName($class_name)
    {
        $this->class_name = $class_name;
    }
    public function setSubjectId($subject_id)
    {
        $this->subject_id = $subject_id;
    }
    public function setSubjectCode($subject_code)
    {
        $this->subject_code = $subject_code;
    }
    public function setSubjectName($subject_name)
    {
        $this->subject_name = $subject_name;
    }
    public function setScore($score)
    {
        $this->score = $score;
    }
}
