Column types
************

There are many column types which you can use. In this file
you'll find more about columns and how to use each one of
them appropriately.

List of all column types
========================

BaseColumn
~~~~~~~~~~

Renders values as they are given. That means that you should always consider
passing an array cause PHP will output it as an Array() while echoed.

BaseColumn is base column which you should extend in order to make new column 
on your own.

ArrayColumn
~~~~~~~~~~~

Not implemented yet.

It should render array values in human recognisable language.

DumpColumn
~~~~~~~~~~

Renders values as if they were outputed by var_dump. Handy when you need to debug
something, but use with caution as it may unveil internal structure of your data.

You can specify if output should be ecnapsulated in pre tags. By setting argument
encapsulateWithPre to true.

IntColumn
~~~~~~~~~

Not implemented yet.

StateColumn
~~~~~~~~~~~

Not implemented yet.

StringColumn
~~~~~~~~~~~~

Renders values as strings.

YesNoColumn
~~~~~~~~~~~

Renders boolean value as a yes or no. String yes and no are automaticaly translated
with translation strings "yes" and "no". You can also define that icon should be
rendered as well. In such a case icon is rendered before string.

Parameters:
    renderText - Defines if text should be rendered (default value: true)
    renderIcon - Defines if con should be rendered (default value: false)

PercentageColumn
~~~~~~~~~~~~~~~~

Not implemented yet.