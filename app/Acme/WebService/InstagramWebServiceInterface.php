<?php
namespace Acme\WebService;


interface InstagramWebServiceInterface{

    function getMostPopularMedia();

    function getMediaByTag($input);

    function getMediaByLocation($input);
}