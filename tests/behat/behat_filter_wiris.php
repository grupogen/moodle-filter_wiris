<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This class provides necessary methods to run behat scripts for wiris plugins.
 * @package    filter
 * @subpackage wiris
 * @copyright  Maths for More S.L. <info@wiris.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../../lib/behat/behat_base.php');

class behat_filter_wiris extends behat_base {
    /**
     * Once the editor has been opened and focused, sets the wiris formula to the specified value.
     *
     * @Given /^I set wiris formula to "(?P<value_string>(?:[^"]|\\")*)"$/
     * @param  string $value value to which we want to set the field
     * @throws ElementNotFoundException If wiris editor does not exist, it will throw an invalid argument exception.
     */
    public function i_set_wiris_formula_to($value) {
        $session = $this->getSession(); // Get the mink session.
        $element = $session->getPage()->find(
            'xpath',
            $session->getSelectorsHandler()->selectorToXpath('xpath', "//input[@class='wrs_focusElement']")
        ); // Runs the actual query and returns the element.
        if (null === $element) {
            throw new \ElementNotFoundException($this->getSession(), get_string('wirisbehaterroreditornotfound', 'filter_wirs'));
        }
        $element->setValue($value);
    }
}
