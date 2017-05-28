<?php
namespace mmedojevicbg\DateDropdown;

use yii\helpers\Html;
use yii\widgets\InputWidget;

class DateDropdown extends InputWidget
{
    /**
     * @var DateDropdownAsset
     */
    protected $asset;
    protected $fieldName;
    protected $dayDropdownId;
    protected $monthDropdownId;
    protected $yearDropdownId;
    public $tokens = [];
    public function init()
    {
        parent::init();
        if ($this->hasModel()) {
            $this->fieldName = $this->attribute;
        } else {
            $this->fieldName = $this->name;
        }
        $this->createDayDropdownId();
        $this->createMonthDropdownId();
        $this->createYearDropdownId();
    }
    public function run()
    {
        $this->options['id'] = $this->textAreaId;
        if ($this->hasModel()) {
            $currentDate = $this->attribute;
            echo Html::activeHiddenInput($this->model, $this->attribute, $this->options);
        } else {
            $currentDate = $this->value;
            echo Html::hiddenInput($this->name, $this->value, $this->options);
        }
        $this->generateDropdowns();
        $this->registerClientScript();
    }
    protected function generateDropdowns($currentDate) {
        $currentDay = '';
        $currentMonth = '';
        $currentYear = '';
        $currentDateParts = explode('-', $currentDate);
        if(count($currentDateParts) == 3) {
            $currentDay = $currentDateParts[2];
            $currentMonth = $currentDateParts[1];
            $currentYear = $currentDateParts[0];
        }
        echo Html::beginTag('div');
        echo Html::dropDownList($this->createDayDropdownId(), $currentDay, $this->getDays(), ['id' => $this->createDayDropdownId()]);
        echo Html::dropDownList($this->createMonthDropdownId(), $currentMonth, $this->getMonths(), ['id' => $this->createMonthDropdownId()]);
        echo Html::dropDownList($this->createYearDropdownId(), $currentYear, $this->getYears(), ['id' => $this->createYearDropdownId()]);
        echo Html::endTag('div');
    }
    protected function getDays() {
        return ['' => '-- select day --'] + array_combine(range(1, 31), range(1, 31));
    }
    protected function getMonths() {
        $months = [];
        $months[''] = '-- select month --';
        $months['01'] = 'January';
        $months['02'] = 'February';
        $months['03'] = 'March';
        $months['04'] = 'April';
        $months['05'] = 'May';
        $months['06'] = 'June';
        $months['07'] = 'July';
        $months['08'] = 'August';
        $months['09'] = 'September';
        $months['10'] = 'October';
        $months['11'] = 'November';
        $months['12'] = 'December';
        return $months;
    }
    protected function getYears() {
        $years = range(date('Y') - 110, date('Y') + 110);
        $years = array_reverse($years);
        return ['' => '-- select year --'] + array_combine($years, $years);
    }
    protected function registerClientScript()
    {
        $view = $this->getView();
        DateDropdownAsset::register($view);
    }
    private function createDayDropdownId() {
        return $this->dayDropdownId = 'date-dropdown-day-' . $this->fieldName;
    }
    private function createMonthDropdownId() {
        return $this->monthDropdownId = 'date-dropdown-month-' . $this->fieldName;
    }
    private function createYearDropdownId() {
        return $this->yearDropdownId = 'date-dropdown-year-' . $this->fieldName;
    }
}