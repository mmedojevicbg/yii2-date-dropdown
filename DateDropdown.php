<?php
namespace mmedojevicbg\DateDropdown;

use yii\helpers\Html;
use yii\widgets\InputWidget;
use Yii;

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
    protected $hiddenId;
    public $tokens = [];
    public $minYear;
    public $maxYear;
    public function init()
    {
        parent::init();
        if ($this->hasModel()) {
            $this->fieldName = $this->attribute;
        } else {
            $this->fieldName = $this->name;
        }
        if(!$this->minYear) {
            $this->minYear = date('Y') - 100;
        }
        if(!$this->maxYear) {
            $this->maxYear = date('Y');
        }
        $this->createHiddenId();
        $this->createDayDropdownId();
        $this->createMonthDropdownId();
        $this->createYearDropdownId();
    }
    public function run()
    {
        $this->options['id'] = $this->hiddenId;
        if ($this->hasModel()) {
            $currentDate = $this->attribute;
            echo Html::activeHiddenInput($this->model, $this->attribute, $this->options);
        } else {
            $currentDate = $this->value;
            echo Html::hiddenInput($this->name, $this->value, $this->options);
        }
        $this->initI18N(__DIR__);
        $this->generateDropdowns($currentDate);
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
        echo Html::dropDownList($this->createDayDropdownId(), $currentDay, $this->getDays(), ['id' => $this->createDayDropdownId(), 'class' => 'date-dropdown', 'data-field' => $this->fieldName]);
        echo '&nbsp;&nbsp;';
        echo Html::dropDownList($this->createMonthDropdownId(), $currentMonth, $this->getMonths(), ['id' => $this->createMonthDropdownId(), 'class' => 'date-dropdown', 'data-field' => $this->fieldName]);
        echo '&nbsp;&nbsp;';
        echo Html::dropDownList($this->createYearDropdownId(), $currentYear, $this->getYears(), ['id' => $this->createYearDropdownId(), 'class' => 'date-dropdown', 'data-field' => $this->fieldName]);
        echo Html::endTag('div');
    }
    protected function getDays() {
        $days = range(1, 31);
        foreach($days as &$day) {
            $day =  sprintf("%02d", $day);
        }
        return ['' => '-- ' . Yii::t('app', 'Select day') . ' --'] + array_combine($days, $days);
    }
    protected function getMonths() {
        $months = [];
        $months[''] = '-- ' . Yii::t('app', 'Select month') . ' --';
        $months['01'] = Yii::t('app', 'January');
        $months['02'] = Yii::t('app', 'February');
        $months['03'] = Yii::t('app', 'March');
        $months['04'] = Yii::t('app', 'April');
        $months['05'] = Yii::t('app', 'May');
        $months['06'] = Yii::t('app', 'June');
        $months['07'] = Yii::t('app', 'July');
        $months['08'] = Yii::t('app', 'August');
        $months['09'] = Yii::t('app', 'September');
        $months['10'] = Yii::t('app', 'October');
        $months['11'] = Yii::t('app', 'November');
        $months['12'] = Yii::t('app', 'December');
        return $months;
    }
    protected function getYears() {
        $years = range($this->minYear, $this->maxYear);
        $years = array_reverse($years);
        return ['' => '-- ' . Yii::t('app', 'Select year') . ' --'] + array_combine($years, $years);
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
    protected function createHiddenId() {
        return $this->hiddenId = 'date-dropdown-hidden-' . $this->fieldName;
    }
}