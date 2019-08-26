<?php

namespace App\Entity;

class EventSearch {

    /**
     * @var int|null
     */
    private $maxPrice;


    private $searchRubric;


    private $searchDate;


    /**
     * Get the value of maxPrice
     *
     * @return  int|null
     */ 
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * Set the value of maxPrice
     *
     * @param  int|null  $maxPrice
     * @return  self
     */ 
    public function setMaxPrice(int $maxPrice)
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }


    /**
     * Get the value of searchRubric
     *
     * @return  int|null
     */ 
    public function getSearchRubric(): ?int
    {
        return $this->searchRubric;
    }

    /**
     * Set the value of searchRubric
     *
     * @param  int|null  $searchRubric
     * @return  self
     */ 
    public function setSearchRubric(int $searchRubric)
    {
        $this->searchRubric = $searchRubric;
        return $this;
    }


    /**
     * Undocumented function
     *
     * @return integer|null
     */
    public function getSearchDate(): ?int
    {
        return $this->searchDate;
    }

/**
 * Undocumented function
 *
 * @param integer $searchDate
 * @return void
 */
    public function setSearchDate(int $searchDate)
    {
        $this->searchDate = $searchDate;
        return $this;
    }


}