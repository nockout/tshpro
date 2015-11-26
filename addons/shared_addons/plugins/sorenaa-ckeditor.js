CKEDITOR.plugins.add( 'sorenaa',
{   
   requires : ['richcombo'], //, 'styles' ],
   init : function( editor )
   {
      var config = editor.config,
         lang = editor.lang.format;

      // Gets the list of tags from the settings.
      var tags = []; //new Array();
      //this.add('value', 'drop_text', 'drop_label');
      tags[0]=["{{ sorenaa:alert style=%27info%27 }} My Content {{ /sorenaa:alert }}", "Alert", "Alert"];
      tags[1]=["{{ sorenaa:align position=%27left%27 }} My Content {{ /sorenaa:align }}", "Align", "Align"];
      tags[2]=["{{ sorenaa:badge style=%27%27 }} My Content {{ /sorenaa:badge }}", "Badge", "Badge"];
      tags[3]=["{{ sorenaa:carousel slug=%27Gallery Slug%27 }}", "Carousel", "Carousel"];
      tags[4]=["{{ sorenaa:collapse title=%27My Title%27 }} My Content  {{ /sorenaa:collapse }}", "Collapse", "Collapse"];
      tags[5]=["{{ sorenaa:emphasis style=%27%27 }} My Content  {{ /sorenaa:emphasis }}", "Emphasis", "Emphasis"];
      tags[6]=["{{ sorenaa:hero }} My Content  {{ /sorenaa:hero }}", "Hero", "Hero"];
      tags[7]=["{{ sorenaa:label style=%27%27 }} My Content {{ /sorenaa:label }}", "Label", "Label"];
      tags[8]=["{{ sorenaa:lead }} My Content  {{ /sorenaa:lead }}", "Lead", "Lead"];
      tags[9]=["{{ sorenaa:row }} {{ sorenaa:span size=%27%27 }} My Content  {{ /sorenaa:span }} {{ /sorenaa:row }}", "Row - Span", "Row - Span"];
      tags[10]=["{{ sorenaa:tabheaderwrap }}<p>{{ sorenaa:tabheader title=%27Tab One%27 active=%27true%27 }}</p><p>{{ sorenaa:tabheader title=%27Tab Two%27 }}</p><p>{{ /sorenaa:tabheaderwrap }}</p><p>{{ sorenaa:tabcontentwrap }}</p><p>{{ sorenaa:tabcontent title=%27Tab One%27 active=%27true%27 }}Tab one contents goes here{{ /sorenaa:tabcontent }}</p><p>{{ sorenaa:tabcontent title=%27Tab Two%27 }} Tab two contents goes here{{ /sorenaa:tabcontent }}</p><p>{{ /sorenaa:tabcontentwrap }}</p>", "Tabs", "Tabs"];
      tags[11]=["{{ sorenaa:well }} My Content  {{ /sorenaa:well }}", "Well", "Well"];
      tags[12]=["{{ sorenaa:repbar }} {{ sorenaa:largebar h3=%27 MY-MAIN-TITLE %27}} MY-DESCRIPTION {{ /sorenaa:largebar }} {{ sorenaa:smallbar title=%27 MY-TITLE %27 link=%27 MY-PAGE-LINK %27 button=%27 MY-BUTTON-TEXT %27}} MY_DESCRIPTION{{ /sorenaa:smallbar }}{{ /sorenaa:repbar }}", "REP-BAR", "REP-BAR"];
      tags[13]=["{{ sorenaa:iconbox title=%27MAIN-TITLE%27 class=%27ICON CLASS%27 }} DESCRIPTION {{ /sorenaa:iconbox }}", "Iconbox", "Iconbox"];
      tags[14]=["{{ sorenaa:imageLightbox image-id=%27 IMAGE_ID %27 title=%27 TITLE %27}}", "Image - Lightbox", "Image - Lightbox"];
      tags[15]=["{{ sorenaa:videoLightbox image-id=%27 IMAGE_ID %27 video-url=%27 VIDEO URL %27 title=%27 TITLE %27}}", "Video - Lightbox", "Video - Lightbox"];
      // Create style objects for all defined styles.
      editor.ui.addRichCombo( 'sorenaa',
         {
            label : "sorenaa",
            title :"sorenaa",
            voiceLabel : "sorenaa",
            className : 'cke_format',
            multiSelect : false,

            panel :
            {
               css : [ config.contentsCss, CKEDITOR.getUrl( CKEDITOR.skin.getPath('editor')  + 'editor.css' ) ],
               voiceLabel : lang.panelVoiceLabel
            },

            init : function()
            {
               this.startGroup( "sorenaa" );
               //this.add('value', 'drop_text', 'drop_label');
               for (var this_tag in tags){
                  this.add(tags[this_tag][0], tags[this_tag][1], tags[this_tag][2]);
               }
            },

            onClick : function( value )
            {         
               editor.focus();
               editor.fire( 'saveSnapshot' );
               editor.insertHtml(unescape(value));
               editor.fire( 'saveSnapshot' );
            }
         });
   }
});

/*

Include this file:
   // get path of directory ckeditor
   var basePath = CKEDITOR.basePath;
   basePath = basePath.substr(0, basePath.indexOf("ckeditor/")); 
   (function() {
      CKEDITOR.plugins.addExternal('sorenaa',basePath+'../../../../../addons/shared_addons/themes/MY_THEME/js/', 'sorenaa-ckeditor.js');
   })();

Add 'sorenaa' to extra plugins:
   extraPlugins: 'pyroimages,pyrofiles,sorenaa',

Then add 'sorenaa' to a toolbar

*/