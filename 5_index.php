<?php
// Challenge: refactor these interfaces into more sensible architecture (add new interfaces where required)

interface FlightBookingSystemInterface
{
        public function getAllAirports();
}

interface AirportInterface
{
        public function getPossibleDestinationAirports();
        public function getDepartureTimes(AirportInterface $destination);
}

interface UserInterface
{

}


interface FlightInterface
{
        public function __construct(AirportInterface $origin, AirportInterface $destination, $time);
        public function getCost(UserInterface $user);
        public function book(UserInterface $user, $cost);
}

?>
