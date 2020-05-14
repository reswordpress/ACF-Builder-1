<?php

namespace ACFBuilder\Builders;

class FieldGroup
{
    const GROUP_NAMESPACE = 'group';

    private $key;

    private $title;

    private $fields = [];

    private $location = [];

    private $menuOrder;

    private $position = 'normal';

    private $style = 'default';

    private $labelPlacement = 'top';

    private $instructionPlacement = 'label';

    private $hideOnScreen = '';

    public function __construct($title, $menuOrder = 0)
    {
        $this->title = $title;

        $this->menuOrder = $menuOrder;

        $this->setKey($title);
    }

    private function setKey($key)
    {
        if (!preg_match('/^' . static::GROUP_NAMESPACE . '/', $key)) {
            $key = static::GROUP_NAMESPACE . '_' . $key;
        }

        $key = strtolower($key);

        $key = str_replace('-', '', $key);
        $key = str_replace(' ', '_', $key);
        $key = str_replace('__', '_', $key);

        var_dump($key);

        $this->key = $key;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function setStyle($style)
    {
        $this->style = $style;
    }

    public function setLabelPlacement($labelPlacement)
    {
        $this->labelPlacement = $labelPlacement;
    }

    public function setInstructionsPlacement($instructionPlacement)
    {
        $this->instructionPlacement = $instructionPlacement;
    }

    public function setHideOnScreen($hideOnScreen)
    {
        $this->hideOnScreen = $hideOnScreen;
    }

    public function addField($field)
    {
        array_push($this->fields, $field);
    }

    public function addLocation($location)
    {
        array_push($this->location, $location);
    }

    private function buildBuildable($buildables)
    {
        $data = [];

        if (!is_array($buildables)) {
            return [];
        }

        foreach ($buildables as $buildable) {
            array_push($data, $buildable->build($this->key));
        }

        return $data;
    }

    private function buildFields()
    {
        return $this->buildBuildable($this->fields);
    }

    private function buildLocations()
    {
        return $this->buildBuildable($this->location);
    }

    public function build()
    {
        $fields = $this->buildFields();
        $locations = $this->buildLocations();

        return [
            'key' => $this->key,
            'title' => $this->title,
            'fields' => $fields,
            'location' => $locations,
            'menu_order' => $this->menuOrder,
            'position' => $this->position,
            'style' => $this->style,
            'label_placement' => $this->labelPlacement,
            'instruction_placement' => $this->instructionPlacement,
            'hide_on_screen' => $this->hideOnScreen,
        ];
    }

    public function register()
    {
        if (function_exists('acf_add_local_field_group')) {
            $fieldGroup = $this->build();

            acf_add_local_field_group($fieldGroup);
        }
    }
}