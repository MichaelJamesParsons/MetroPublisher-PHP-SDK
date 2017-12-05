<?php

namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;

/**
 * Class File
 * @package MetroPublisher\Api\Models
 */
class File extends AbstractResourceModel
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

    /** @var  string|bool */
    protected $file_content;

    /**
     * @inheritdoc
     */
    public function save()
    {
        $return = parent::doSave("/files/{$this->uuid}");

        if (!empty($this->file_content)) {
            $this->uploadFile($this->file_content);
        }

        return $return;
    }

    /**
     * @param $file_stream
     *
     * @return array
     * @throws \Exception
     */
    protected function uploadFile($file_stream)
    {
        $fileType = ($this->fileType === 'image/jpg') ? 'image/jpeg' : $this->fileType;
        $response = $this->context->post("/files/{$this->uuid}", [], [
            "headers" => [
                'Content-Type' => $fileType
            ],
            'body'    => $file_stream
        ]);

        if ($response['error']) {
            throw new \Exception($response['error_description']);
        }

        return $response;
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        return parent::doDelete("/files/{$this->uuid}");
    }

    /**
     * @return array
     */
    protected function loadMetaData()
    {
        // @todo handle this
        return null;
    }

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
     *
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
     *
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
     *
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
     *
     * @return $this
     */
    public function setFileType($fileType)
    {
        $this->fileType = $fileType;

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
     *
     * @return $this
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * @param bool|string $file_content
     *
     * @return File
     */
    public function setFileContent($file_content)
    {
        $this->file_content = $file_content;

        return $this;
    }
}