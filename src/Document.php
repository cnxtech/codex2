<?php
/**
 * Part of the Caffeinated PHP packages.
 *
 * MIT License and copyright information bundled with this package in the LICENSE file
 */
namespace Codex\Codex;

use Illuminate\Filesystem\Filesystem;

/**
 * This is the Document.
 *
 * @package        Codex\Codex
 * @author         Caffeinated Dev Team
 * @copyright      Copyright (c) 2015, Caffeinated
 * @license        https://tldrlegal.com/license/mit-license MIT License
 */
class Document
{

    /**
     * @var \Codex\Codex\Project
     */
    protected $project;

    /**
     * @var
     */
    protected $path;

    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var
     */
    protected $attributes;


    /**
     * @param \Codex\Codex\Project              $project
     * @param \Illuminate\Filesystem\Filesystem $files
     * @param                                   $path
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function __construct(Project $project, Filesystem $files, $path)
    {
        $this->project = $project;
        $this->files   = $files;
        $this->path    = $path;
        $this->content        = $this->files->get($this->path);
    }

    /**
     * render the document. Will run all document:render hooks and then return the output. Should be called in view
     *
     * @return string
     */
    public function render()
    {
        Factory::run('document:render', [$this]);
        return $this->content;
    }

    /**
     * attr
     *
     * @param $key
     * @return array
     */
    public function attr($key=null)
    {

        return is_null($key) ? $this->attributes : array_get($this->attributes, $key);
    }

    /**
     * get path value
     *
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * get content value
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the content value
     *
     * @param string $content
     * @return Document
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * get attributes value
     *
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Set the attributes value
     *
     * @param mixed $attributes
     * @return Document
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * get project value
     *
     * @return \Codex\Codex\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * get files value
     *
     * @return \Illuminate\Filesystem\Filesystem
     */
    public function getFiles()
    {
        return $this->files;
    }



}