(function(wp) {
  var registerBlockType = wp.blocks.registerBlockType;
  var createElement = wp.element.createElement;
  var useBlockProps = wp.blockEditor.useBlockProps;
  var InspectorControls = wp.blockEditor.InspectorControls;
  var PanelBody = wp.components.PanelBody;
  var TextControl = wp.components.TextControl;
  var TextareaControl = wp.components.TextareaControl;
  var SelectControl = wp.components.SelectControl;
  var ToggleControl = wp.components.ToggleControl;
  var RangeControl = wp.components.RangeControl;

  // Color options shared across blocks.
  var colorOptions = [
    { label: 'Cyan', value: 'cyan' },
    { label: 'Yellow', value: 'yellow' },
    { label: 'Red', value: 'red' },
    { label: 'White', value: 'white' }
  ];

  // ── Hero Block ──
  registerBlockType('neobrutheme/hero', {
    edit: function(props) {
      var attrs = props.attributes;
      var setAttrs = props.setAttributes;
      var blockProps = useBlockProps({
        className: 'neobrutheme-block neobrutheme-hero bg-' + attrs.bgColor
      });

      return createElement('div', blockProps,
        createElement('div', { className: 'p-8 border-4 border-black' },
          createElement('h1', {
            className: 'text-4xl font-black uppercase mb-2',
            style: { WebkitTextStroke: '3px black', color: 'transparent' }
          }, attrs.heading || 'Hero Heading'),
          attrs.subheading && createElement('p', { className: 'text-lg font-bold' }, attrs.subheading),
          createElement(InspectorControls, null,
            createElement(PanelBody, { title: 'Hero Settings' },
              createElement(TextControl, {
                label: 'Heading',
                value: attrs.heading,
                onChange: function(val) { setAttrs({ heading: val }); }
              }),
              createElement(TextareaControl, {
                label: 'Subheading',
                value: attrs.subheading,
                onChange: function(val) { setAttrs({ subheading: val }); }
              }),
              createElement(SelectControl, {
                label: 'Background Color',
                value: attrs.bgColor,
                options: colorOptions,
                onChange: function(val) { setAttrs({ bgColor: val }); }
              }),
              createElement(ToggleControl, {
                label: 'Show Composition Panel',
                checked: attrs.showComposition,
                onChange: function(val) { setAttrs({ showComposition: val }); }
              })
            )
          )
        )
      );
    },
    save: function() { return null; } // Server-side rendered.
  });

  // ── Marquee Block ──
  registerBlockType('neobrutheme/marquee', {
    edit: function(props) {
      var attrs = props.attributes;
      var setAttrs = props.setAttributes;
      var blockProps = useBlockProps({
        className: 'neobrutheme-block neobrutheme-marquee bg-' + attrs.color
      });

      return createElement('div', blockProps,
        createElement('div', { className: 'p-4 border-4 border-black overflow-hidden' },
          createElement('div', { className: 'text-2xl font-black uppercase whitespace-nowrap' },
            (attrs.text || 'Marquee text...') + ' ' + (attrs.text || 'Marquee text...')
          ),
          createElement(InspectorControls, null,
            createElement(PanelBody, { title: 'Marquee Settings' },
              createElement(TextControl, {
                label: 'Text',
                value: attrs.text,
                onChange: function(val) { setAttrs({ text: val }); }
              }),
              createElement(SelectControl, {
                label: 'Speed',
                value: attrs.speed,
                options: [
                  { label: 'Slow', value: 'slow' },
                  { label: 'Medium', value: 'medium' },
                  { label: 'Fast', value: 'fast' }
                ],
                onChange: function(val) { setAttrs({ speed: val }); }
              }),
              createElement(SelectControl, {
                label: 'Color',
                value: attrs.color,
                options: colorOptions,
                onChange: function(val) { setAttrs({ color: val }); }
              })
            )
          )
        )
      );
    },
    save: function() { return null; }
  });

  // ── CTA Block ──
  registerBlockType('neobrutheme/cta', {
    edit: function(props) {
      var attrs = props.attributes;
      var setAttrs = props.setAttributes;
      var blockProps = useBlockProps({
        className: 'neobrutheme-block neobrutheme-cta bg-' + attrs.color
      });

      return createElement('div', blockProps,
        createElement('div', { className: 'p-12 border-4 border-black text-center' },
          createElement('h2', {
            className: 'text-3xl font-black uppercase mb-4',
            style: { WebkitTextStroke: '3px black', color: 'transparent' }
          }, attrs.heading || 'Call to Action'),
          attrs.buttonText && createElement('span', {
            className: 'inline-block px-6 py-3 border-4 border-black font-black uppercase text-sm'
          }, attrs.buttonText),
          createElement(InspectorControls, null,
            createElement(PanelBody, { title: 'CTA Settings' },
              createElement(TextControl, {
                label: 'Heading',
                value: attrs.heading,
                onChange: function(val) { setAttrs({ heading: val }); }
              }),
              createElement(TextControl, {
                label: 'Button Text',
                value: attrs.buttonText,
                onChange: function(val) { setAttrs({ buttonText: val }); }
              }),
              createElement(TextControl, {
                label: 'Button URL',
                value: attrs.buttonUrl,
                onChange: function(val) { setAttrs({ buttonUrl: val }); }
              }),
              createElement(SelectControl, {
                label: 'Background Color',
                value: attrs.color,
                options: colorOptions,
                onChange: function(val) { setAttrs({ color: val }); }
              })
            )
          )
        )
      );
    },
    save: function() { return null; }
  });

  // ── Stat Cards Block ──
  registerBlockType('neobrutheme/stat-cards', {
    edit: function(props) {
      var attrs = props.attributes;
      var setAttrs = props.setAttributes;
      var blockProps = useBlockProps({ className: 'neobrutheme-block neobrutheme-stat-cards' });
      var stats = attrs.stats || [];

      function addStat() {
        setAttrs({ stats: stats.concat([{ number: 0, label: '', color: 'yellow', shape: 'default' }]) });
      }
      function updateStat(index, field, value) {
        var newStats = stats.slice();
        newStats[index][field] = value;
        setAttrs({ stats: newStats });
      }
      function removeStat(index) {
        setAttrs({ stats: stats.filter(function(_, i) { return i !== index; }) });
      }

      return createElement('div', blockProps,
        createElement('div', { className: 'p-6 border-4 border-black' },
          createElement('div', { className: 'grid grid-cols-3 gap-4 mb-4' },
            stats.map(function(stat, i) {
              return createElement('div', { key: i, className: 'p-4 border-4 border-black text-center bg-' + stat.color },
                createElement('div', { className: 'text-3xl font-black mb-1' }, stat.number || '0'),
                createElement('div', { className: 'text-xs font-black uppercase' }, stat.label || 'Label'),
                createElement('button', {
                  className: 'mt-2 text-xs underline',
                  onClick: function() { removeStat(i); }
                }, 'Remove')
              );
            })
          ),
          createElement('button', {
            className: 'px-4 py-2 border-4 border-black font-black uppercase text-sm bg-white',
            onClick: addStat
          }, 'Add Stat'),
          createElement(InspectorControls, null,
            createElement(PanelBody, { title: 'Stat Cards' },
              stats.map(function(stat, i) {
                return createElement(PanelBody, { key: i, title: 'Stat ' + (i + 1) },
                  createElement(TextControl, {
                    label: 'Number',
                    value: String(stat.number),
                    onChange: function(val) { updateStat(i, 'number', parseInt(val) || 0); }
                  }),
                  createElement(TextControl, {
                    label: 'Label',
                    value: stat.label,
                    onChange: function(val) { updateStat(i, 'label', val); }
                  }),
                  createElement(SelectControl, {
                    label: 'Color',
                    value: stat.color,
                    options: colorOptions,
                    onChange: function(val) { updateStat(i, 'color', val); }
                  }),
                  createElement(SelectControl, {
                    label: 'Shape',
                    value: stat.shape,
                    options: [
                      { label: 'Square', value: 'default' },
                      { label: 'Circle', value: 'circle' },
                      { label: 'Diamond', value: 'diamond' }
                    ],
                    onChange: function(val) { updateStat(i, 'shape', val); }
                  })
                );
              })
            )
          )
        )
      );
    },
    save: function() { return null; }
  });

  // ── Testimonials Block ──
  registerBlockType('neobrutheme/testimonials', {
    edit: function(props) {
      var attrs = props.attributes;
      var setAttrs = props.setAttributes;
      var blockProps = useBlockProps({ className: 'neobrutheme-block neobrutheme-testimonials' });
      var testimonials = attrs.testimonials || [];

      function addTestimonial() {
        setAttrs({ testimonials: testimonials.concat([{ quote: '', author: '', role: '' }]) });
      }
      function updateTestimonial(index, field, value) {
        var newTestimonials = testimonials.slice();
        newTestimonials[index][field] = value;
        setAttrs({ testimonials: newTestimonials });
      }
      function removeTestimonial(index) {
        setAttrs({ testimonials: testimonials.filter(function(_, i) { return i !== index; }) });
      }

      return createElement('div', blockProps,
        createElement('div', { className: 'p-6 border-4 border-black' },
          attrs.heading && createElement('h2', { className: 'text-2xl font-black uppercase mb-4' }, attrs.heading),
          createElement('div', { className: 'grid grid-cols-2 gap-4 mb-4' },
            testimonials.map(function(t, i) {
              return createElement('div', { key: i, className: 'p-4 border-4 border-black bg-white' },
                createElement('p', { className: 'text-sm italic mb-2' }, '"' + (t.quote || 'Quote') + '"'),
                createElement('p', { className: 'text-xs font-black' }, t.author || 'Author'),
                t.role && createElement('p', { className: 'text-xs opacity-60' }, t.role),
                createElement('button', {
                  className: 'mt-2 text-xs underline',
                  onClick: function() { removeTestimonial(i); }
                }, 'Remove')
              );
            })
          ),
          createElement('button', {
            className: 'px-4 py-2 border-4 border-black font-black uppercase text-sm bg-white',
            onClick: addTestimonial
          }, 'Add Testimonial'),
          createElement(InspectorControls, null,
            createElement(PanelBody, { title: 'Testimonials' },
              createElement(TextControl, {
                label: 'Heading',
                value: attrs.heading,
                onChange: function(val) { setAttrs({ heading: val }); }
              }),
              testimonials.map(function(t, i) {
                return createElement(PanelBody, { key: i, title: 'Testimonial ' + (i + 1) },
                  createElement(TextareaControl, {
                    label: 'Quote',
                    value: t.quote,
                    onChange: function(val) { updateTestimonial(i, 'quote', val); }
                  }),
                  createElement(TextControl, {
                    label: 'Author',
                    value: t.author,
                    onChange: function(val) { updateTestimonial(i, 'author', val); }
                  }),
                  createElement(TextControl, {
                    label: 'Role',
                    value: t.role,
                    onChange: function(val) { updateTestimonial(i, 'role', val); }
                  })
                );
              })
            )
          )
        )
      );
    },
    save: function() { return null; }
  });

  // ── Content Grid Block ──
  registerBlockType('neobrutheme/content-grid', {
    edit: function(props) {
      var attrs = props.attributes;
      var setAttrs = props.setAttributes;
      var blockProps = useBlockProps({ className: 'neobrutheme-block neobrutheme-content-grid' });

      return createElement('div', blockProps,
        createElement('div', { className: 'p-6 border-4 border-black' },
          attrs.heading && createElement('h2', { className: 'text-2xl font-black uppercase mb-4' }, attrs.heading),
          createElement('p', { className: 'text-sm opacity-60' },
            'Shows ' + attrs.count + ' ' + attrs.postType + ' items in ' + attrs.columns + ' columns'
          ),
          createElement(InspectorControls, null,
            createElement(PanelBody, { title: 'Content Grid Settings' },
              createElement(TextControl, {
                label: 'Heading',
                value: attrs.heading,
                onChange: function(val) { setAttrs({ heading: val }); }
              }),
              createElement(SelectControl, {
                label: 'Post Type',
                value: attrs.postType,
                options: [
                  { label: 'Blog Posts', value: 'post' },
                  { label: 'Portfolio', value: 'portfolio' },
                  { label: 'Team', value: 'team' },
                  { label: 'Services', value: 'service' }
                ],
                onChange: function(val) { setAttrs({ postType: val }); }
              }),
              createElement(RangeControl, {
                label: 'Number of Items',
                value: attrs.count,
                min: 1,
                max: 12,
                onChange: function(val) { setAttrs({ count: val }); }
              }),
              createElement(SelectControl, {
                label: 'Columns',
                value: attrs.columns,
                options: [
                  { label: '2', value: '2' },
                  { label: '3', value: '3' },
                  { label: '4', value: '4' }
                ],
                onChange: function(val) { setAttrs({ columns: val }); }
              })
            )
          )
        )
      );
    },
    save: function() { return null; }
  });

  // ── Services Block ──
  registerBlockType('neobrutheme/services', {
    edit: function(props) {
      var attrs = props.attributes;
      var setAttrs = props.setAttributes;
      var blockProps = useBlockProps({ className: 'neobrutheme-block neobrutheme-services' });

      return createElement('div', blockProps,
        createElement('div', { className: 'p-6 border-4 border-black' },
          attrs.heading && createElement('h2', { className: 'text-2xl font-black uppercase mb-4' }, attrs.heading),
          createElement('p', { className: 'text-sm opacity-60' }, 'Services shown as ' + attrs.style),
          createElement(InspectorControls, null,
            createElement(PanelBody, { title: 'Services Settings' },
              createElement(TextControl, {
                label: 'Heading',
                value: attrs.heading,
                onChange: function(val) { setAttrs({ heading: val }); }
              }),
              createElement(SelectControl, {
                label: 'Style',
                value: attrs.style,
                options: [
                  { label: 'Grid', value: 'grid' },
                  { label: 'List', value: 'list' }
                ],
                onChange: function(val) { setAttrs({ style: val }); }
              })
            )
          )
        )
      );
    },
    save: function() { return null; }
  });

  // ── Divider Block ──
  registerBlockType('neobrutheme/divider', {
    edit: function(props) {
      var attrs = props.attributes;
      var setAttrs = props.setAttributes;
      var blockProps = useBlockProps({ className: 'neobrutheme-block neobrutheme-divider' });

      return createElement('div', blockProps,
        createElement('div', { className: 'p-4 border-4 border-black' },
          createElement('hr', {
            className: 'border-t-8 border-black',
            style: attrs.style === 'color' ? { borderTopColor: attrs.color } : {}
          }),
          createElement(InspectorControls, null,
            createElement(PanelBody, { title: 'Divider Settings' },
              createElement(SelectControl, {
                label: 'Style',
                value: attrs.style,
                options: [
                  { label: 'Thick Border', value: 'thick' },
                  { label: 'Color Bar', value: 'color' },
                  { label: 'Spacer', value: 'spacer' }
                ],
                onChange: function(val) { setAttrs({ style: val }); }
              }),
              attrs.style === 'color' && createElement(SelectControl, {
                label: 'Color',
                value: attrs.color,
                options: colorOptions,
                onChange: function(val) { setAttrs({ color: val }); }
              })
            )
          )
        )
      );
    },
    save: function() { return null; }
  });

  // ── FAQ Block ──
  registerBlockType('neobrutheme/faq', {
    edit: function(props) {
      var attrs = props.attributes;
      var setAttrs = props.setAttributes;
      var blockProps = useBlockProps({ className: 'neobrutheme-block neobrutheme-faq' });
      var items = attrs.items || [];

      function addItem() {
        setAttrs({ items: items.concat([{ question: '', answer: '' }]) });
      }
      function updateItem(index, field, value) {
        var newItems = items.slice();
        newItems[index][field] = value;
        setAttrs({ items: newItems });
      }
      function removeItem(index) {
        setAttrs({ items: items.filter(function(_, i) { return i !== index; }) });
      }

      return createElement('div', blockProps,
        createElement('div', { className: 'p-6 border-4 border-black' },
          attrs.heading && createElement('h2', { className: 'text-2xl font-black uppercase mb-4' }, attrs.heading),
          createElement('div', { className: 'space-y-2 mb-4' },
            items.map(function(item, i) {
              return createElement('div', { key: i, className: 'p-3 border-4 border-black bg-white' },
                createElement('p', { className: 'font-black text-sm' }, item.question || 'Question'),
                createElement('p', { className: 'text-xs opacity-60 mt-1' }, item.answer || 'Answer'),
                createElement('button', {
                  className: 'mt-2 text-xs underline',
                  onClick: function() { removeItem(i); }
                }, 'Remove')
              );
            })
          ),
          createElement('button', {
            className: 'px-4 py-2 border-4 border-black font-black uppercase text-sm bg-white',
            onClick: addItem
          }, 'Add Question'),
          createElement(InspectorControls, null,
            createElement(PanelBody, { title: 'FAQ Settings' },
              createElement(TextControl, {
                label: 'Heading',
                value: attrs.heading,
                onChange: function(val) { setAttrs({ heading: val }); }
              }),
              items.map(function(item, i) {
                return createElement(PanelBody, { key: i, title: 'Question ' + (i + 1) },
                  createElement(TextControl, {
                    label: 'Question',
                    value: item.question,
                    onChange: function(val) { updateItem(i, 'question', val); }
                  }),
                  createElement(TextareaControl, {
                    label: 'Answer',
                    value: item.answer,
                    onChange: function(val) { updateItem(i, 'answer', val); }
                  })
                );
              })
            )
          )
        )
      );
    },
    save: function() { return null; }
  });

  // ── Video Block ──
  registerBlockType('neobrutheme/video', {
    edit: function(props) {
      var attrs = props.attributes;
      var setAttrs = props.setAttributes;
      var blockProps = useBlockProps({ className: 'neobrutheme-block neobrutheme-video' });

      return createElement('div', blockProps,
        createElement('div', { className: 'p-6 border-4 border-black' },
          attrs.heading && createElement('h2', { className: 'text-2xl font-black uppercase mb-4' }, attrs.heading),
          createElement('div', { className: 'aspect-video bg-black flex items-center justify-center' },
            createElement('p', { className: 'text-white font-black' }, attrs.url ? 'Video: ' + attrs.url : 'No video URL set')
          ),
          createElement(InspectorControls, null,
            createElement(PanelBody, { title: 'Video Settings' },
              createElement(TextControl, {
                label: 'Heading',
                value: attrs.heading,
                onChange: function(val) { setAttrs({ heading: val }); }
              }),
              createElement(TextControl, {
                label: 'Video URL',
                value: attrs.url,
                help: 'YouTube or Vimeo URL',
                onChange: function(val) { setAttrs({ url: val }); }
              }),
              createElement(SelectControl, {
                label: 'Aspect Ratio',
                value: attrs.aspectRatio,
                options: [
                  { label: '16:9', value: '16/9' },
                  { label: '4:3', value: '4/3' },
                  { label: '1:1', value: '1/1' }
                ],
                onChange: function(val) { setAttrs({ aspectRatio: val }); }
              })
            )
          )
        )
      );
    },
    save: function() { return null; }
  });

})(window.wp);
