<?php

namespace App\Traits;

trait Locale
{
    protected function lang(){
        return app()->getLocale();
    }

    public function getContentAttribute(){
        $column = "content_" . $this->lang();
        return $this->{$column};
    }

    public function getContent2Attribute(){
        $column = "content2_" . $this->lang();
        return $this->{$column};
    }

    protected function getTitleAttribute(){
        $column = "title_" . $this->lang();
        return $this->{$column};
    }

    public function getDescriptionAttribute(){
        $column = "description_" . $this->lang();
        return $this->{$column};
    }

    public function getKeywordsAttribute(){
        $column = "keywords_" . $this->lang();
        return $this->{$column};
    }

    public function getAttributesAttribute(){
        $column = "attributes_" . $this->lang();
        return $this->{$column};
    }

    protected function getNameAttribute(){
        $column = "name_" . $this->lang();
        return $this->{$column};
    }

    protected function getValueAttribute(){
        $column = "value_" . $this->lang();
        return $this->{$column};
    }

    protected function getStringAttribute(){
        $column = "string_" . $this->lang();
        return $this->{$column};
    }

}
