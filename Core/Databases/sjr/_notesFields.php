<?php

namespace Core\Databases\sjr;

class _notesFields
{

    private $NotesID;
    private $MemberID;
    private $NotesDesc;
    private $NotesLink;
    private $NoteClue;
    private $NotesValid;

    //  Additional Fields

    public function __construct(array $inArray)
    {
        if (is_array($inArray)) {
            $loop = array_keys($inArray);
            foreach ($loop as $key => $value) {
                if (property_exists($this, $value)) {
                    $this->$value = $inArray[$value];
                }
            }
        }
    }

    /**
     * @return mixed
     */
    public function getNotesID()
    {
        return $this->NotesID;
    }

    /**
     * @param mixed $NotesID
     */
    public function setNotesID($NotesID): void
    {
        $this->NotesID = $NotesID;
    }

    /**
     * @return mixed
     */
    public function getMemberID()
    {
        return $this->MemberID;
    }

    /**
     * @param mixed $MemberID
     */
    public function setMemberID($MemberID): void
    {
        $this->MemberID = $MemberID;
    }

    /**
     * @return mixed
     */
    public function getNotesDesc()
    {
        return $this->NotesDesc;
    }

    /**
     * @param mixed $NotesDesc
     */
    public function setNotesDesc($NotesDesc): void
    {
        $this->NotesDesc = $NotesDesc;
    }

    /**
     * @return mixed
     */
    public function getNotesLink()
    {
        return $this->NotesLink;
    }

    /**
     * @param mixed $NotesLink
     */
    public function setNotesLink($NotesLink): void
    {
        $this->NotesLink = $NotesLink;
    }

    /**
     * @return mixed
     */
    public function getNoteClue()
    {
        return $this->NoteClue;
    }

    /**
     * @param mixed $NoteClue
     */
    public function setNoteClue($NoteClue): void
    {
        $this->NoteClue = $NoteClue;
    }

    /**
     * @return mixed
     */
    public function getNotesValid()
    {
        return $this->NotesValid;
    }

    /**
     * @param mixed $NotesValid
     */
    public function setNotesValid($NotesValid): void
    {
        $this->NotesValid = $NotesValid;
    }




}