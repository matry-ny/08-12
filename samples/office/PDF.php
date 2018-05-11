<?php

namespace app;

use FPDF;

/**
 * Class PDF
 * @package app
 */
class PDF
{
    const PORTRAIT_ORIENTATION = 'P';

    const MILLIMETER_POINTS = 'mm';

    const A4_FORMAT = 'A4';

    const BROWSER_OUTPUT = 'I';
    const FILE_OUTPUT = 'F';

    const ARIAL_FAMILY = 'Arial';

    const BOLD_TEXT = 'B';

    /**
     * @var null|FPDF
     */
    private $fpdf;

    /**
     * @return FPDF
     */
    public function getBuilder()
    {
        if (null === $this->fpdf) {
            $this->fpdf = new FPDF($this->orientation, $this->points, $this->format);
        }

        return $this->fpdf;
    }

    /**
     * @var string
     */
    private $orientation = self::PORTRAIT_ORIENTATION;

    /**
     * @param string $orientation
     * @return PDF
     */
    public function setOrientation(string $orientation): PDF
    {
        $this->orientation = $orientation;
        return $this;
    }

    /**
     * @var string
     */
    private $points = self::MILLIMETER_POINTS;

    /**
     * @param string $points
     * @return PDF
     */
    public function setPoints(string $points): PDF
    {
        $this->points = $points;
        return $this;
    }

    /**
     * @var string
     */
    private $format = self::A4_FORMAT;

    /**
     * @param string $format
     * @return PDF
     */
    public function setFormat(string $format): PDF
    {
        $this->format = $format;
        return $this;
    }
}