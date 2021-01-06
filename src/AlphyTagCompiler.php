<?php

namespace Cierrateam\Alphy;

use Illuminate\Container\Container;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Str;
use Illuminate\View\AnonymousComponent;
use Illuminate\View\Compilers\ComponentTagCompiler;
use Illuminate\View\DynamicComponent;

class AlphyTagCompiler extends ComponentTagCompiler
{

    /**
     * Compile the component and slot tags within the given string.
     *
     * @param string $value
     * @return string
     */
    public function compile(string $value)
    {
        return $this->compileTags($value);
    }

    /**
     * Compile the tags within the given string.
     *
     * @param string $value
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function compileTags(string $value)
    {
        $value = $this->compileOpeningTags($value);
        $value = $this->compileClosingTags($value);
        return $value;
    }

    /**
     * Compile the opening tags within the given string.
     *
     * @param string $value
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function compileOpeningTags(string $value)
    {
        $pattern = "/
            <
                \s*
                a[-\:]([\w\-\:\.]*)
                (?<attributes>
                    (?:
                        \s+
                        (?:
                            (?:
                                \{\{\s*\\\$attributes(?:[^}]+?)?\s*\}\}
                            )
                            |
                            (?:
                                [\w\-:.@]+
                                (
                                    =
                                    (?:
                                        \\\"[^\\\"]*\\\"
                                        |
                                        \'[^\']*\'
                                        |
                                        [^\'\\\"=<>]+
                                    )
                                )?
                            )
                        )
                    )*
                    \s*
                )
                (?<![\/=\-])
            >
        /x";

        return preg_replace_callback($pattern, function (array $matches) {
            $component = $matches[1];
            $attributes = $matches['attributes'];
            return "<div x-data=\"$component()\" $attributes>";
        }, $value);
    }

    /**
     * Compile the closing tags within the given string.
     *
     * @param string $value
     * @return string
     */
    protected function compileClosingTags(string $value)
    {
        return preg_replace("/<\/\s*a[-\:][\w\-\:\.]*\s*>/", ' </div> ', $value);
    }

}
