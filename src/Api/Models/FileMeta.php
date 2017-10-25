<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;

class FileMeta extends AbstractResourceModel
{
    /** @var  string */
    protected $title;

    /** @var  string */
    protected $description;

    /** @var  string */
    protected $filename;

    /** @var  string */
    protected $fileType;

    /** @var  \DateTime */
    protected $created;

    /** @var  \DateTime */
    protected $modified;

    /** @var  string */
    protected $credits;

    /** @var  File */
    protected $file;

    public static function getDefaultFields()
    {
        return [
            'uuid',
            'created',
            'modified',
            'title',
            'description',
            'filename',
            'fileType',
            'created',
            'modified',
            'credits'
        ];
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     * @return $this
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileType()
    {
        return $this->fileType;
    }

    /**
     * @param string $fileType
     * @return $this
     */
    public function setFileType($fileType)
    {
        $this->fileType = $fileType;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     * @return $this
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param \DateTime $modified
     * @return $this
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
        return $this;
    }

    /**
     * @return string
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * @param string $credits
     * @return $this
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;
        return $this;
    }

    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param File $file
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $return = parent::doSave("/files/{$this->uuid}");
        $this->uploadFile();

        return $return;
    }

    /**
     * @inheritdoc
     */
    protected function delete()
    {
        return parent::doDelete("/files/{$this->uuid}");
    }

    public function uploadFile()
    {
        $response = $this->context->post(
            "/files/{$this->uuid}",
            [],
            [
                "headers" => [
                    'Content-Type' => 'image/' . $this->fileType
                ],
                'body' => file_get_contents($this->file->getStoredPath())
            ]
        );

        if($response['error']) {
            throw new \Exception($response['error_description']);
        }

        return $response;
    }

    /**
     * @inheritdoc
     */
    public static function getFieldNames()
    {
        return array_merge([
            'title',
            'description',
            'filename',
            'credits'
        ], parent::getFieldNames());
    }

    /**
     * @return array
     */
    protected function loadMetaData()
    {
        // @todo handle this
        return null;
    }
}