<?php

namespace MusicBrainz;

/**
 * Represents a MusicBrainz release group
 *
 */
class ReleaseGroup
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var array
     */
    private $data;
    /**
     * @var MusicBrainz
     */
    private $brainz;
    /**
     * @var Release[]
     */
    private $releases = array();

    /**
     * @param array       $releaseGroup
     * @param MusicBrainz $brainz
     */
    public function __construct(array $releaseGroup, MusicBrainz $brainz)
    {
        $this->data   = $releaseGroup;
        $this->brainz = $brainz;

        $this->id = isset($releaseGroup['id']) ? (string)$releaseGroup['id'] : '';
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->data['title'];
    }
    
    /**
     * @return string
     */
    public function getType()
    {
        return $this->data['primary-type'];
        
    }
    
    public function getArtist()
    {
        return $this->data['artist-credit'][0]['artist']['name'];
        
    }
    
    public function getReleasesID()
    {
        return $this->data['releases'][0]['id'];
        
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->data['score'];
    }

    /**
     * @return Release[]
     */
    public function getReleases()
    {
        if (!empty($this->releases)) {
            return $this->releases;
        }

        foreach ($this->data['releases'] as $release) {
            array_push($this->releases, new Release($release, $this->brainz));
        }

        return $this->releases;
    }
}
