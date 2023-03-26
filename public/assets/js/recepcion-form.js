crud.field('has_material').onChange(function (e, value) {
    if (value.target.value === '1') {
        crud.field('material').enable();
    } else {
        crud.field('material').disable();
    }
});