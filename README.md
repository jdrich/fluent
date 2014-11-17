Fluent
======

A very simple class for wrapping non-fluent objects in fluent interfaces to clean up code.

**Usage**

Without `Fluent\Adapter`:

    $object = new SomeClass();

    $object->oscillate();
    $object->rotate();
    $object->invert();
    $object->tessellate();
    $object->slice(3, 5);

    return $object->print();

With `Fluent\Adapter`:

    return (new Fluent\Adapter(new SomeClass(), ['print']))
        ->oscillate()
        ->rotate()
        ->invert()
        ->tessellate()
        ->slice(3, 5)
        ->print();
