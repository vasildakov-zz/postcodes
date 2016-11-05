<?php
namespace Domain\Entity {

    interface PostcodeInterface
    {
        public function getId();

        public function getPostcode();

        public function getLatitude();

        public function getLongitude();
    }
}
