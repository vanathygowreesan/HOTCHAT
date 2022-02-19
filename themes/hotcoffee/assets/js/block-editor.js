//console.log('Block Editor');

wp.blocks.registerBlockStyle( 'core/quote', {
    name: 'fancy-quote',
    label: 'Fancy Quote',
} );

wp.domReady( function () {
    wp.blocks.unregisterBlockStyle( 'core/quote', 'large' );
    wp.blocks.unregisterBlockStyle( 'core/quote', 'plain' )
} ); 

wp.blocks.registerBlockStyle( 'core/button', {
    name: 'fill-button',
    label: 'Fill Button',
} );

wp.blocks.registerBlockStyle( 'core/button', {
    name: 'outline-button',
    label: 'Outline Button',
} );

wp.blocks.registerBlockStyle( 'core/heading', {
    name: 'main-heading',
    label: 'Main Heading',
} );

wp.blocks.registerBlockStyle( 'core/heading', {
    name: 'sub-heading',
    label: 'Sub Heading',
} );

