<?php
function getCodeDocument($documentId)
{
    $doc = Document::find($documentId);
    $version = getVersionDocument($documentId);
    $type = DocumentType::find($doc->type_id)->code;
    $class = ClassModel::find($doc->class_id)->code;
    $subject = ClassModel::find($doc->subject_id)->code;
    $level = ClassModel::find($doc->level_id)->code;
    $numberLesson = Lesson::find($doc->lesson_id)->code;
    $code = $type.'_'.$class.'_'.$subject.'_'.$level.'_'.$numberLesson.'_'.$documentId.'_'.$version;
    return $code;
}

function getVersionDocument($documentId)
{
    return 1;
}
