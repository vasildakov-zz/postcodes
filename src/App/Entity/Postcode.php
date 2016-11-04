<?php
namespace App\Entity;

class Postcode implements PostcodeInterface, \JsonSerializable
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $postcode;

    /**
     * @var float
     *
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;


    /**
     * @param int       $id
     * @param string    $postcode
     * @param float     $latitude
     * @param float     $longitude
     */
    public function __construct($id, $postcode, $latitude, $longitude)
    {
        $this->id = $id;
        $this->postcode = $postcode;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     *
     * @return Postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Postcode
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Postcode
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }


    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }


    public function jsonSerialize()
    {
        return [
            'id'        => (int) $this->id,
            'postcode'  => (string) $this->postcode,
            'latitude'  => (float) $this->latitude,
            'longitude' => (float) $this->longitude,
        ];
    }
}
