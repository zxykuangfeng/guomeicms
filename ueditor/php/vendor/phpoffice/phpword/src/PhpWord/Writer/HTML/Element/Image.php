<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @see         https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2018 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Writer\HTML\Element;

use PhpOffice\PhpWord\Element\Image as ImageElement;
use PhpOffice\PhpWord\Writer\HTML\Style\Image as ImageStyleWriter;

/**
 * Image element HTML writer
 *
 * @since 0.10.0
 */
class Image extends Text
{
    /**
     * Write image
     *
     * @return string
     */
    public function write()
    {
        if (!$this->element instanceof ImageElement) {
            return '';
        }
        $content = '';
        $imageData = $this->element->getImageStringData(true);
        if ($imageData !== null) {
            $styleWriter = new ImageStyleWriter($this->element->getStyle());
            $style = $styleWriter->write();
			$reg_height = "/height:.{2,8}px;/i";
			$reg_width = "/width:.{2,8}px;/i";
			$height = preg_match($reg_height, $style, $height_temp);
			$width = preg_match($reg_width, $style, $width_temp);
			$get_height = $get_width = 0;
			if($height_temp){
				$style = str_replace($height_temp[0],'',$style);
				$get_height = trim(str_replace(['px;','height:'],'',$height_temp[0]));
				$style = trim($style);
			}
			if($width_temp){
				$style = str_replace($width_temp[0],'',$style);
				$get_width = trim(str_replace(['px;','width:'],'',$width_temp[0]));
				$style = trim($style);
			}			
            $imageData = 'data:' . $this->element->getImageType() . ';base64,' . $imageData;

            $content .= $this->writeOpening();
            $content .= '<img border="0" style="'.$style.'" '.($get_height ? 'height="'.$get_height.'"' : '').' '.($get_width ? 'width="'.$get_width.'"' : '').' src="'.$imageData.'"/>';
            $content .= $this->writeClosing();
        }

        return $content;
    }
}
