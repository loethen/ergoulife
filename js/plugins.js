// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function noop() {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.
//rate

/*!
 * jQuery Raty - A Star Rating Plugin
 * ------------------------------------------------------------------
 *
 * jQuery Raty is a plugin that generates a customizable star rating.
 *
 * Licensed under The MIT License
 *
 * @version        2.5.2
 * @since          2010.06.11
 * @author         Washington Botelho
 * @documentation  wbotelhos.com/raty
 *
 * ------------------------------------------------------------------
 *
 *  <div id="star"></div>
 *
 *  $('#star').raty();
 *
 */

;(function($) {

  var methods = {
    init: function(settings) {
      return this.each(function() {
        methods.destroy.call(this);

        this.opt = $.extend(true, {}, $.fn.raty.defaults, settings);

        var that  = $(this),
            inits = ['number', 'readOnly', 'score', 'scoreName'];

        methods._callback.call(this, inits);

        if (this.opt.precision) {
          methods._adjustPrecision.call(this);
        }

        this.opt.number = methods._between(this.opt.number, 0, this.opt.numberMax)

        this.opt.path = this.opt.path || '';

        if (this.opt.path && this.opt.path.slice(this.opt.path.length - 1, this.opt.path.length) !== '/') {
          this.opt.path += '/';
        }

        this.stars = methods._createStars.call(this);
        this.score = methods._createScore.call(this);

        methods._apply.call(this, this.opt.score);

        var space  = this.opt.space ? 4 : 0,
            width  = this.opt.width || (this.opt.number * this.opt.size + this.opt.number * space);

        if (this.opt.cancel) {
          this.cancel = methods._createCancel.call(this);

          width += (this.opt.size + space);
        }

        if (this.opt.readOnly) {
          methods._lock.call(this);
        } else {
          that.css('cursor', 'pointer');
          methods._binds.call(this);
        }

        if (this.opt.width !== false) {
          that.css('width', width);
        }

        methods._target.call(this, this.opt.score);

        that.data({ 'settings': this.opt, 'raty': true });
      });
    }, _adjustPrecision: function() {
      this.opt.targetType = 'score';
      this.opt.half       = true;
    }, _apply: function(score) {
      if (score && score > 0) {
        score = methods._between(score, 0, this.opt.number);
        this.score.val(score);
      }

      methods._fill.call(this, score);

      if (score) {
        methods._roundStars.call(this, score);
      }
    }, _between: function(value, min, max) {
      return Math.min(Math.max(parseFloat(value), min), max);
    }, _binds: function() {
      if (this.cancel) {
        methods._bindCancel.call(this);
      }

      methods._bindClick.call(this);
      methods._bindOut.call(this);
      methods._bindOver.call(this);
    }, _bindCancel: function() {
      methods._bindClickCancel.call(this);
      methods._bindOutCancel.call(this);
      methods._bindOverCancel.call(this);
    }, _bindClick: function() {
      var self = this,
          that = $(self);

      self.stars.on('click.raty', function(evt) {
        self.score.val((self.opt.half || self.opt.precision) ? that.data('score') : this.alt);

        if (self.opt.click) {
          self.opt.click.call(self, parseFloat(self.score.val()), evt);
        }
      });
    }, _bindClickCancel: function() {
      var self = this;

      self.cancel.on('click.raty', function(evt) {
        self.score.removeAttr('value');

        if (self.opt.click) {
          self.opt.click.call(self, null, evt);
        }
      });
    }, _bindOut: function() {
      var self = this;

      $(this).on('mouseleave.raty', function(evt) {
        var score = parseFloat(self.score.val()) || undefined;

        methods._apply.call(self, score);
        methods._target.call(self, score, evt);

        if (self.opt.mouseout) {
          self.opt.mouseout.call(self, score, evt);
        }
      });
    }, _bindOutCancel: function() {
      var self = this;

      self.cancel.on('mouseleave.raty', function(evt) {
        $(this).attr('src', self.opt.path + self.opt.cancelOff);

        if (self.opt.mouseout) {
          self.opt.mouseout.call(self, self.score.val() || null, evt);
        }
      });
    }, _bindOverCancel: function() {
      var self = this;

      self.cancel.on('mouseover.raty', function(evt) {
        $(this).attr('src', self.opt.path + self.opt.cancelOn);

        self.stars.attr('src', self.opt.path + self.opt.starOff);

        methods._target.call(self, null, evt);

        if (self.opt.mouseover) {
          self.opt.mouseover.call(self, null);
        }
      });
    }, _bindOver: function() {
      var self   = this,
          that   = $(self),
          action = self.opt.half ? 'mousemove.raty' : 'mouseover.raty';

      self.stars.on(action, function(evt) {
        var score = parseInt(this.alt, 10);

        if (self.opt.half) {
          var position = parseFloat((evt.pageX - $(this).offset().left) / self.opt.size),
              plus     = (position > .5) ? 1 : .5;

          score = score - 1 + plus;

          methods._fill.call(self, score);

          if (self.opt.precision) {
            score = score - plus + position;
          }

          methods._roundStars.call(self, score);

          that.data('score', score);
        } else {
          methods._fill.call(self, score);
        }

        methods._target.call(self, score, evt);

        if (self.opt.mouseover) {
          self.opt.mouseover.call(self, score, evt);
        }
      });
    }, _callback: function(options) {
      for (i in options) {
        if (typeof this.opt[options[i]] === 'function') {
          this.opt[options[i]] = this.opt[options[i]].call(this);
        }
      }
    }, _createCancel: function() {
      var that   = $(this),
          icon   = this.opt.path + this.opt.cancelOff,
          cancel = $('<img />', { src: icon, alt: 'x', title: this.opt.cancelHint, 'class': 'raty-cancel' });

      if (this.opt.cancelPlace == 'left') {
        that.prepend('&#160;').prepend(cancel);
      } else {
        that.append('&#160;').append(cancel);
      }

      return cancel;
    }, _createScore: function() {
      return $('<input />', { type: 'hidden', name: this.opt.scoreName }).appendTo(this);
    }, _createStars: function() {
      var that = $(this);

      for (var i = 1; i <= this.opt.number; i++) {
        var title = methods._getHint.call(this, i),
            icon  = (this.opt.score && this.opt.score >= i) ? 'starOn' : 'starOff';

        icon = this.opt.path + this.opt[icon];

        $('<img />', { src : icon, alt: i, title: title }).appendTo(this);

        if (this.opt.space) {
          that.append((i < this.opt.number) ? '&#160;' : '');
        }
      }

      return that.children('img');
    }, _error: function(message) {
      $(this).html(message);

      $.error(message);
    }, _fill: function(score) {
      var self  = this,
          hash  = 0;

      for (var i = 1; i <= self.stars.length; i++) {
        var star   = self.stars.eq(i - 1),
            select = self.opt.single ? (i == score) : (i <= score);

        if (self.opt.iconRange && self.opt.iconRange.length > hash) {
          var irange = self.opt.iconRange[hash],
              on     = irange.on  || self.opt.starOn,
              off    = irange.off || self.opt.starOff,
              icon   = select ? on : off;

          if (i <= irange.range) {
            star.attr('src', self.opt.path + icon);
          }

          if (i == irange.range) {
            hash++;
          }
        } else {
          var icon = select ? 'starOn' : 'starOff';

          star.attr('src', this.opt.path + this.opt[icon]);
        }
      }
    }, _getHint: function(score) {
      var hint = this.opt.hints[score - 1];
      return (hint === '') ? '' : (hint || score);
    }, _lock: function() {
      var score = parseInt(this.score.val(), 10), // TODO: 3.1 >> [['1'], ['2'], ['3', '.1', '.2']]
          hint  = score ? methods._getHint.call(this, score) : this.opt.noRatedMsg;

      $(this).data('readonly', true).css('cursor', '').attr('title', hint);

      this.score.attr('readonly', 'readonly');
      this.stars.attr('title', hint);

      if (this.cancel) {
        this.cancel.hide();
      }
    }, _roundStars: function(score) {
      var rest = (score - Math.floor(score)).toFixed(2);

      if (rest > this.opt.round.down) {
        var icon = 'starOn';                                 // Up:   [x.76 .. x.99]

        if (this.opt.halfShow && rest < this.opt.round.up) { // Half: [x.26 .. x.75]
          icon = 'starHalf';
        } else if (rest < this.opt.round.full) {             // Down: [x.00 .. x.5]
          icon = 'starOff';
        }

        this.stars.eq(Math.ceil(score) - 1).attr('src', this.opt.path + this.opt[icon]);
      }                              // Full down: [x.00 .. x.25]
    }, _target: function(score, evt) {
      if (this.opt.target) {
        var target = $(this.opt.target);

        if (target.length === 0) {
          methods._error.call(this, 'Target selector invalid or missing!');
        }

        if (this.opt.targetFormat.indexOf('{score}') < 0) {
          methods._error.call(this, 'Template "{score}" missing!');
        }

        var mouseover = evt && evt.type == 'mouseover';

        if (score === undefined) {
          score = this.opt.targetText;
        } else if (score === null) {
          score = mouseover ? this.opt.cancelHint : this.opt.targetText;
        } else {
          if (this.opt.targetType == 'hint') {
            score = methods._getHint.call(this, Math.ceil(score));
          } else if (this.opt.precision) {
            score = parseFloat(score).toFixed(1);
          }

          if (!mouseover && !this.opt.targetKeep) {
            score = this.opt.targetText;
          }
        }

        if (score) {
          score = this.opt.targetFormat.toString().replace('{score}', score);
        }

        if (target.is(':input')) {
          target.val(score);
        } else {
          target.html(score);
        }
      }
    }, _unlock: function() {
      $(this).data('readonly', false).css('cursor', 'pointer').removeAttr('title');

      this.score.removeAttr('readonly', 'readonly');

      for (var i = 0; i < this.opt.number; i++) {
        this.stars.eq(i).attr('title', methods._getHint.call(this, i + 1));
      }

      if (this.cancel) {
        this.cancel.css('display', '');
      }
    }, cancel: function(click) {
      return this.each(function() {
        if ($(this).data('readonly') !== true) {
          methods[click ? 'click' : 'score'].call(this, null);
          this.score.removeAttr('value');
        }
      });
    }, click: function(score) {
      return $(this).each(function() {
        if ($(this).data('readonly') !== true) {
          methods._apply.call(this, score);

          if (!this.opt.click) {
            methods._error.call(this, 'You must add the "click: function(score, evt) { }" callback.');
          }

          this.opt.click.call(this, score, { type: 'click' });

          methods._target.call(this, score);
        }
      });
    }, destroy: function() {
      return $(this).each(function() {
        var that = $(this),
            raw  = that.data('raw');

        if (raw) {
          that.off('.raty').empty().css({ cursor: raw.style.cursor, width: raw.style.width }).removeData('readonly');
        } else {
          that.data('raw', that.clone()[0]);
        }
      });
    }, getScore: function() {
      var score = [],
          value ;

      $(this).each(function() {
        value = this.score.val();

        score.push(value ? parseFloat(value) : undefined);
      });

      return (score.length > 1) ? score : score[0];
    }, readOnly: function(readonly) {
      return this.each(function() {
        var that = $(this);

        if (that.data('readonly') !== readonly) {
          if (readonly) {
            that.off('.raty').children('img').off('.raty');

            methods._lock.call(this);
          } else {
            methods._binds.call(this);
            methods._unlock.call(this);
          }

          that.data('readonly', readonly);
        }
      });
    }, reload: function() {
      return methods.set.call(this, {});
    }, score: function() {
      return arguments.length ? methods.setScore.apply(this, arguments) : methods.getScore.call(this);
    }, set: function(settings) {
      return this.each(function() {
        var that   = $(this),
            actual = that.data('settings'),
            news   = $.extend({}, actual, settings);

        that.raty(news);
      });
    }, setScore: function(score) {
      return $(this).each(function() {
        if ($(this).data('readonly') !== true) {
          methods._apply.call(this, score);
          methods._target.call(this, score);
        }
      });
    }
  };

  $.fn.raty = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else if (typeof method === 'object' || !method) {
      return methods.init.apply(this, arguments);
    } else {
      $.error('Method ' + method + ' does not exist!');
    }
  };

  $.fn.raty.defaults = {
    cancel        : false,
    cancelHint    : 'Cancel this rating!',
    cancelOff     : 'cancel-off.png',
    cancelOn      : 'cancel-on.png',
    cancelPlace   : 'left',
    click         : undefined,
    half          : false,
    halfShow      : true,
    hints         : ['bad', 'poor', 'regular', 'good', 'gorgeous'],
    iconRange     : undefined,
    mouseout      : undefined,
    mouseover     : undefined,
    noRatedMsg    : 'Not rated yet!',
    number        : 5,
    numberMax     : 20,
    path          : '',
    precision     : false,
    readOnly      : false,
    round         : { down: .25, full: .6, up: .76 },
    score         : undefined,
    scoreName     : 'score',
    single        : false,
    size          : 16,
    space         : true,
    starHalf      : 'star-half.png',
    starOff       : 'star-off.png',
    starOn        : 'star-on.png',
    target        : undefined,
    targetFormat  : '{score}',
    targetKeep    : false,
    targetText    : '',
    targetType    : 'hint',
    width         : undefined
  };

})(jQuery);


//hover
;( function( $, window, undefined ) {
    
    'use strict';

    $.HoverDir = function( options, element ) {
        
        this.$el = $( element );
        this._init( options );

    };

    // the options
    $.HoverDir.defaults = {
        speed : 300,
        easing : 'ease',
        hoverDelay : 0,
        inverse : false
    };

    $.HoverDir.prototype = {

        _init : function( options ) {
            
            // options
            this.options = $.extend( true, {}, $.HoverDir.defaults, options );
            // transition properties
            this.transitionProp = 'all ' + this.options.speed + 'ms ' + this.options.easing;
            // support for CSS transitions
            this.support = Modernizr.csstransitions;
            // load the events
            this._loadEvents();

        },
        _loadEvents : function() {

            var self = this;
            
            this.$el.on( 'mouseenter.hoverdir, mouseleave.hoverdir', function( event ) {
                
                var $el = $( this ),
                    $hoverElem = $el.find( 'div' ),
                    direction = self._getDir( $el, { x : event.pageX, y : event.pageY } ),
                    styleCSS = self._getStyle( direction );

                if( event.type === 'mouseenter' ) {
                    
                    $hoverElem.hide().css( styleCSS.from );
                    clearTimeout( self.tmhover );

                    self.tmhover = setTimeout( function() {
                        
                        $hoverElem.show( 0, function() {
                            
                            var $el = $( this );
                            if( self.support ) {
                                $el.css( 'transition', self.transitionProp );
                            }
                            self._applyAnimation( $el, styleCSS.to, self.options.speed );

                        } );
                        
                    
                    }, self.options.hoverDelay );
                    
                }
                else {
                
                    if( self.support ) {
                        $hoverElem.css( 'transition', self.transitionProp );
                    }
                    clearTimeout( self.tmhover );
                    self._applyAnimation( $hoverElem, styleCSS.from, self.options.speed );
                    
                }
                    
            } );

        },
        // credits : http://stackoverflow.com/a/3647634
        _getDir : function( $el, coordinates ) {
            
            // the width and height of the current div
            var w = $el.width(),
                h = $el.height(),

                // calculate the x and y to get an angle to the center of the div from that x and y.
                // gets the x value relative to the center of the DIV and "normalize" it
                x = ( coordinates.x - $el.offset().left - ( w/2 )) * ( w > h ? ( h/w ) : 1 ),
                y = ( coordinates.y - $el.offset().top  - ( h/2 )) * ( h > w ? ( w/h ) : 1 ),
            
                // the angle and the direction from where the mouse came in/went out clockwise (TRBL=0123);
                // first calculate the angle of the point,
                // add 180 deg to get rid of the negative values
                // divide by 90 to get the quadrant
                // add 3 and do a modulo by 4  to shift the quadrants to a proper clockwise TRBL (top/right/bottom/left) **/
                direction = Math.round( ( ( ( Math.atan2(y, x) * (180 / Math.PI) ) + 180 ) / 90 ) + 3 ) % 4;
            return direction;
            
        },
        _getStyle : function( direction ) {
            
            var fromStyle, toStyle,
                slideFromTop = { left : '0px', top : '-100%' },
                slideFromBottom = { left : '0px', top : '100%' },
                slideFromLeft = { left : '-100%', top : '0px' },
                slideFromRight = { left : '100%', top : '0px' },
                slideTop = { top : '0px' },
                slideLeft = { left : '0px' };
            
            switch( direction ) {
                case 0:
                    // from top
                    fromStyle = !this.options.inverse ? slideFromTop : slideFromBottom;
                    toStyle = slideTop;
                    break;
                case 1:
                    // from right
                    fromStyle = !this.options.inverse ? slideFromRight : slideFromLeft;
                    toStyle = slideLeft;
                    break;
                case 2:
                    // from bottom
                    fromStyle = !this.options.inverse ? slideFromBottom : slideFromTop;
                    toStyle = slideTop;
                    break;
                case 3:
                    // from left
                    fromStyle = !this.options.inverse ? slideFromLeft : slideFromRight;
                    toStyle = slideLeft;
                    break;
            };
            
            return { from : fromStyle, to : toStyle };
                    
        },
        // apply a transition or fallback to jquery animate based on Modernizr.csstransitions support
        _applyAnimation : function( el, styleCSS, speed ) {

            $.fn.applyStyle = this.support ? $.fn.css : $.fn.animate;
            el.stop().applyStyle( styleCSS, $.extend( true, [], { duration : speed + 'ms' } ) );

        },

    };
    
    var logError = function( message ) {

        if ( window.console ) {

            window.console.error( message );
        
        }

    };
    
    $.fn.hoverdir = function( options ) {

        var instance = $.data( this, 'hoverdir' );
        if ( typeof options === 'string' ) {
            
            var args = Array.prototype.slice.call( arguments, 1 );
            
            this.each(function() {
            
                if ( !instance ) {

                    logError( "cannot call methods on hoverdir prior to initialization; " +
                    "attempted to call method '" + options + "'" );
                    return;
                
                }
                
                if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {

                    logError( "no such method '" + options + "' for hoverdir instance" );
                    return;
                
                }
                
                instance[ options ].apply( instance, args );
            
            });
        
        } 
        else {
        
            this.each(function() {
                
                if ( instance ) {

                    instance._init();
                
                }
                else {

                    instance = $.data( this, 'hoverdir', new $.HoverDir( options, this ) );
                    
                }

            });
        
        }
        
        return instance;
        
    };
    
} )( jQuery, window );

/*!
  jQuery ColorBox v1.4.4 - 2013-03-10
  (c) 2013 Jack Moore - jacklmoore.com/colorbox
  license: http://www.opensource.org/licenses/mit-license.php
*/
(function ($, document, window) {
  var
  // Default settings object.
  // See http://jacklmoore.com/colorbox for details.
  defaults = {
    transition: "elastic",
    speed: 300,
    width: false,
    initialWidth: "600",
    innerWidth: false,
    maxWidth: false,
    height: false,
    initialHeight: "450",
    innerHeight: false,
    maxHeight: false,
    scalePhotos: true,
    scrolling: true,
    inline: false,
    html: false,
    iframe: false,
    fastIframe: true,
    photo: false,
    href: false,
    title: false,
    rel: false,
    opacity: 0.9,
    preloading: true,
    className: false,
    
    // alternate image paths for high-res displays
    retinaImage: false,
    retinaUrl: false,
    retinaSuffix: '@2x.$1',

    // internationalization
    current: "image {current} of {total}",
    previous: "previous",
    next: "next",
    close: "close",
    xhrError: "This content failed to load.",
    imgError: "This image failed to load.",

    open: false,
    returnFocus: true,
    reposition: true,
    loop: true,
    slideshow: false,
    slideshowAuto: true,
    slideshowSpeed: 2500,
    slideshowStart: "start slideshow",
    slideshowStop: "stop slideshow",
    photoRegex: /\.(gif|png|jp(e|g|eg)|bmp|ico)((#|\?).*)?$/i,

    onOpen: false,
    onLoad: false,
    onComplete: false,
    onCleanup: false,
    onClosed: false,
    overlayClose: true,
    escKey: true,
    arrowKey: true,
    top: false,
    bottom: false,
    left: false,
    right: false,
    fixed: false,
    data: undefined
  },
  
  // Abstracting the HTML and event identifiers for easy rebranding
  colorbox = 'colorbox',
  prefix = 'cbox',
  boxElement = prefix + 'Element',
  
  // Events
  event_open = prefix + '_open',
  event_load = prefix + '_load',
  event_complete = prefix + '_complete',
  event_cleanup = prefix + '_cleanup',
  event_closed = prefix + '_closed',
  event_purge = prefix + '_purge',
  
  // Special Handling for IE
  isIE = !$.support.leadingWhitespace, // IE6 to IE8
  isIE6 = isIE && !window.XMLHttpRequest, // IE6
  event_ie6 = prefix + '_IE6',

  // Cached jQuery Object Variables
  $overlay,
  $box,
  $wrap,
  $content,
  $topBorder,
  $leftBorder,
  $rightBorder,
  $bottomBorder,
  $related,
  $window,
  $loaded,
  $loadingBay,
  $loadingOverlay,
  $title,
  $current,
  $slideshow,
  $next,
  $prev,
  $close,
  $groupControls,
  $events = $({}),
  
  // Variables for cached values or use across multiple functions
  settings,
  interfaceHeight,
  interfaceWidth,
  loadedHeight,
  loadedWidth,
  element,
  index,
  photo,
  open,
  active,
  closing,
  loadingTimer,
  publicMethod,
  div = "div",
  className,
  requests = 0,
  init;

  // ****************
  // HELPER FUNCTIONS
  // ****************
  
  // Convience function for creating new jQuery objects
  function $tag(tag, id, css) {
    var element = document.createElement(tag);

    if (id) {
      element.id = prefix + id;
    }

    if (css) {
      element.style.cssText = css;
    }

    return $(element);
  }
  
  // Get the window height using innerHeight when available to avoid an issue with iOS
  // http://bugs.jquery.com/ticket/6724
  function winheight() {
    return window.innerHeight ? window.innerHeight : $(window).height();
  }

  // Determine the next and previous members in a group.
  function getIndex(increment) {
    var
    max = $related.length,
    newIndex = (index + increment) % max;
    
    return (newIndex < 0) ? max + newIndex : newIndex;
  }

  // Convert '%' and 'px' values to integers
  function setSize(size, dimension) {
    return Math.round((/%/.test(size) ? ((dimension === 'x' ? $window.width() : winheight()) / 100) : 1) * parseInt(size, 10));
  }
  
  // Checks an href to see if it is a photo.
  // There is a force photo option (photo: true) for hrefs that cannot be matched by the regex.
  function isImage(settings, url) {
    return settings.photo || settings.photoRegex.test(url);
  }

  function retinaUrl(settings, url) {
    return settings.retinaUrl && window.devicePixelRatio > 1 ? url.replace(settings.photoRegex, settings.retinaSuffix) : url;
  }

  function trapFocus(e) {
    if ('contains' in $box[0] && !$box[0].contains(e.target)) {
      e.stopPropagation();
      $box.focus();
    }
  }

  // Assigns function results to their respective properties
  function makeSettings() {
    var i,
      data = $.data(element, colorbox);
    
    if (data == null) {
      settings = $.extend({}, defaults);
      if (console && console.log) {
        console.log('Error: cboxElement missing settings object');
      }
    } else {
      settings = $.extend({}, data);
    }
    
    for (i in settings) {
      if ($.isFunction(settings[i]) && i.slice(0, 2) !== 'on') { // checks to make sure the function isn't one of the callbacks, they will be handled at the appropriate time.
        settings[i] = settings[i].call(element);
      }
    }
    
    settings.rel = settings.rel || element.rel || $(element).data('rel') || 'nofollow';
    settings.href = settings.href || $(element).attr('href');
    settings.title = settings.title || element.title;
    
    if (typeof settings.href === "string") {
      settings.href = $.trim(settings.href);
    }
  }

  function trigger(event, callback) {
    // for external use
    $(document).trigger(event);

    // for internal use
    $events.trigger(event);

    if ($.isFunction(callback)) {
      callback.call(element);
    }
  }

  // Slideshow functionality
  function slideshow() {
    var
    timeOut,
    className = prefix + "Slideshow_",
    click = "click." + prefix,
    clear,
    set,
    start,
    stop;
    
    if (settings.slideshow && $related[1]) {
      clear = function () {
        clearTimeout(timeOut);
      };

      set = function () {
        if (settings.loop || $related[index + 1]) {
          timeOut = setTimeout(publicMethod.next, settings.slideshowSpeed);
        }
      };

      start = function () {
        $slideshow
          .html(settings.slideshowStop)
          .unbind(click)
          .one(click, stop);

        $events
          .bind(event_complete, set)
          .bind(event_load, clear)
          .bind(event_cleanup, stop);

        $box.removeClass(className + "off").addClass(className + "on");
      };
      
      stop = function () {
        clear();
        
        $events
          .unbind(event_complete, set)
          .unbind(event_load, clear)
          .unbind(event_cleanup, stop);
        
        $slideshow
          .html(settings.slideshowStart)
          .unbind(click)
          .one(click, function () {
            publicMethod.next();
            start();
          });

        $box.removeClass(className + "on").addClass(className + "off");
      };
      
      if (settings.slideshowAuto) {
        start();
      } else {
        stop();
      }
    } else {
      $box.removeClass(className + "off " + className + "on");
    }
  }

  function launch(target) {
    if (!closing) {
      
      element = target;
      
      makeSettings();
      
      $related = $(element);
      
      index = 0;
      
      if (settings.rel !== 'nofollow') {
        $related = $('.' + boxElement).filter(function () {
          var data = $.data(this, colorbox),
            relRelated;

          if (data) {
            relRelated =  $(this).data('rel') || data.rel || this.rel;
          }
          
          return (relRelated === settings.rel);
        });
        index = $related.index(element);
        
        // Check direct calls to ColorBox.
        if (index === -1) {
          $related = $related.add(element);
          index = $related.length - 1;
        }
      }
      
            $overlay.css({
                opacity: parseFloat(settings.opacity),
                cursor: settings.overlayClose ? "pointer" : "auto",
                visibility: 'visible'
            }).show();
            
      if (!open) {
        open = active = true; // Prevents the page-change action from queuing up if the visitor holds down the left or right keys.
        
        // Show colorbox so the sizes can be calculated in older versions of jQuery
        $box.css({visibility:'hidden', display:'block'});
        
        $loaded = $tag(div, 'LoadedContent', 'width:0; height:0; overflow:hidden').appendTo($content);

        // Cache values needed for size calculations
        interfaceHeight = $topBorder.height() + $bottomBorder.height() + $content.outerHeight(true) - $content.height();//Subtraction needed for IE6
        interfaceWidth = $leftBorder.width() + $rightBorder.width() + $content.outerWidth(true) - $content.width();
        loadedHeight = $loaded.outerHeight(true);
        loadedWidth = $loaded.outerWidth(true);
        
        
        // Opens inital empty ColorBox prior to content being loaded.
        settings.w = setSize(settings.initialWidth, 'x');
        settings.h = setSize(settings.initialHeight, 'y');
        publicMethod.position();

        if (isIE6) {
          $window.bind('resize.' + event_ie6 + ' scroll.' + event_ie6, function () {
            $overlay.css({width: $window.width(), height: winheight(), top: $window.scrollTop(), left: $window.scrollLeft()});
          }).trigger('resize.' + event_ie6);
        }
        
        slideshow();

        trigger(event_open, settings.onOpen);
        
        $groupControls.add($title).hide();
        
        $close.html(settings.close).show();

                $box.focus();
                
                // Confine focus to the modal
                // Uses event capturing that is not supported in IE8-
                if (document.addEventListener) {

                    document.addEventListener('focus', trapFocus, true);
                    
                    $events.one(event_closed, function () {
                        document.removeEventListener('focus', trapFocus, true);
                    });
                }

                // Return focus on closing
                if (settings.returnFocus) {
                    $events.one(event_closed, function () {
                        $(element).focus();
                    });
                }
      }
      
      publicMethod.load(true);
    }
  }

  // ColorBox's markup needs to be added to the DOM prior to being called
  // so that the browser will go ahead and load the CSS background images.
  function appendHTML() {
    if (!$box && document.body) {
      init = false;

      $window = $(window);
      $box = $tag(div).attr({
                id: colorbox,
                'class': isIE ? prefix + (isIE6 ? 'IE6' : 'IE') : '',
                role: 'dialog',
                tabindex: '-1'
            }).hide();
      $overlay = $tag(div, "Overlay", isIE6 ? 'position:absolute' : '').hide();
      $loadingOverlay = $tag(div, "LoadingOverlay").add($tag(div, "LoadingGraphic"));
      $wrap = $tag(div, "Wrapper");
      $content = $tag(div, "Content").append(
        $title = $tag(div, "Title"),
        $current = $tag(div, "Current"),
                $prev = $tag('button', "Previous"),
        $next = $tag('button', "Next"),
        $slideshow = $tag('button', "Slideshow"),
                $loadingOverlay,
        $close = $tag('button', "Close")
      );
      
      $wrap.append( // The 3x3 Grid that makes up ColorBox
        $tag(div).append(
          $tag(div, "TopLeft"),
          $topBorder = $tag(div, "TopCenter"),
          $tag(div, "TopRight")
        ),
        $tag(div, false, 'clear:left').append(
          $leftBorder = $tag(div, "MiddleLeft"),
          $content,
          $rightBorder = $tag(div, "MiddleRight")
        ),
        $tag(div, false, 'clear:left').append(
          $tag(div, "BottomLeft"),
          $bottomBorder = $tag(div, "BottomCenter"),
          $tag(div, "BottomRight")
        )
      ).find('div div').css({'float': 'left'});
      
      $loadingBay = $tag(div, false, 'position:absolute; width:9999px; visibility:hidden; display:none');
      
      $groupControls = $next.add($prev).add($current).add($slideshow);

      $(document.body).append($overlay, $box.append($wrap, $loadingBay));
    }
  }

  // Add ColorBox's event bindings
  function addBindings() {
    function clickHandler(e) {
      // ignore non-left-mouse-clicks and clicks modified with ctrl / command, shift, or alt.
      // See: http://jacklmoore.com/notes/click-events/
      if (!(e.which > 1 || e.shiftKey || e.altKey || e.metaKey)) {
        e.preventDefault();
        launch(this);
      }
    }

    if ($box) {
      if (!init) {
        init = true;

        // Anonymous functions here keep the public method from being cached, thereby allowing them to be redefined on the fly.
        $next.click(function () {
          publicMethod.next();
        });
        $prev.click(function () {
          publicMethod.prev();
        });
        $close.click(function () {
          publicMethod.close();
        });
        $overlay.click(function () {
          if (settings.overlayClose) {
            publicMethod.close();
          }
        });
        
        // Key Bindings
        $(document).bind('keydown.' + prefix, function (e) {
          var key = e.keyCode;
          if (open && settings.escKey && key === 27) {
            e.preventDefault();
            publicMethod.close();
          }
                    if (open && settings.arrowKey && $related[1] && !e.altKey) {
            if (key === 37) {
              e.preventDefault();
              $prev.click();
            } else if (key === 39) {
              e.preventDefault();
              $next.click();
            }
          }
        });

        if ($.isFunction($.fn.on)) {
          // For jQuery 1.7+
          $(document).on('click.'+prefix, '.'+boxElement, clickHandler);
        } else {
          // For jQuery 1.3.x -> 1.6.x
          // This code is never reached in jQuery 1.9, so do not contact me about 'live' being removed.
          // This is not here for jQuery 1.9, it's here for legacy users.
          $('.'+boxElement).live('click.'+prefix, clickHandler);
        }
      }
      return true;
    }
    return false;
  }

  // Don't do anything if ColorBox already exists.
  if ($.colorbox) {
    return;
  }

  // Append the HTML when the DOM loads
  $(appendHTML);


  // ****************
  // PUBLIC FUNCTIONS
  // Usage format: $.fn.colorbox.close();
  // Usage from within an iframe: parent.$.fn.colorbox.close();
  // ****************
  
  publicMethod = $.fn[colorbox] = $[colorbox] = function (options, callback) {
    var $this = this;
    
    options = options || {};
    
    appendHTML();

    if (addBindings()) {
      if ($.isFunction($this)) { // assume a call to $.colorbox
        $this = $('<a/>');
        options.open = true;
      } else if (!$this[0]) { // colorbox being applied to empty collection
        return $this;
      }
      
      if (callback) {
        options.onComplete = callback;
      }
      
      $this.each(function () {
        $.data(this, colorbox, $.extend({}, $.data(this, colorbox) || defaults, options));
      }).addClass(boxElement);
      
      if (($.isFunction(options.open) && options.open.call($this)) || options.open) {
        launch($this[0]);
      }
    }
    
    return $this;
  };

  publicMethod.position = function (speed, loadedCallback) {
    var
    css,
    top = 0,
    left = 0,
    offset = $box.offset(),
    scrollTop,
    scrollLeft;
    
    $window.unbind('resize.' + prefix);

    // remove the modal so that it doesn't influence the document width/height
    $box.css({top: -9e4, left: -9e4});

    scrollTop = $window.scrollTop();
    scrollLeft = $window.scrollLeft();

    if (settings.fixed && !isIE6) {
      offset.top -= scrollTop;
      offset.left -= scrollLeft;
      $box.css({position: 'fixed'});
    } else {
      top = scrollTop;
      left = scrollLeft;
      $box.css({position: 'absolute'});
    }

    // keeps the top and left positions within the browser's viewport.
    if (settings.right !== false) {
      left += Math.max($window.width() - settings.w - loadedWidth - interfaceWidth - setSize(settings.right, 'x'), 0);
    } else if (settings.left !== false) {
      left += setSize(settings.left, 'x');
    } else {
      left += Math.round(Math.max($window.width() - settings.w - loadedWidth - interfaceWidth, 0) / 2);
    }
    
    if (settings.bottom !== false) {
      top += Math.max(winheight() - settings.h - loadedHeight - interfaceHeight - setSize(settings.bottom, 'y'), 0);
    } else if (settings.top !== false) {
      top += setSize(settings.top, 'y');
    } else {
      top += Math.round(Math.max(winheight() - settings.h - loadedHeight - interfaceHeight, 0) / 2);
    }

    $box.css({top: offset.top, left: offset.left, visibility:'visible'});

    // setting the speed to 0 to reduce the delay between same-sized content.
    speed = ($box.width() === settings.w + loadedWidth && $box.height() === settings.h + loadedHeight) ? 0 : speed || 0;
    
    // this gives the wrapper plenty of breathing room so it's floated contents can move around smoothly,
    // but it has to be shrank down around the size of div#colorbox when it's done.  If not,
    // it can invoke an obscure IE bug when using iframes.
    $wrap[0].style.width = $wrap[0].style.height = "9999px";
    
    function modalDimensions(that) {
      $topBorder[0].style.width = $bottomBorder[0].style.width = $content[0].style.width = (parseInt(that.style.width,10) - interfaceWidth)+'px';
      $content[0].style.height = $leftBorder[0].style.height = $rightBorder[0].style.height = (parseInt(that.style.height,10) - interfaceHeight)+'px';
    }

    css = {width: settings.w + loadedWidth + interfaceWidth, height: settings.h + loadedHeight + interfaceHeight, top: top, left: left};

    if(speed===0){ // temporary workaround to side-step jQuery-UI 1.8 bug (http://bugs.jquery.com/ticket/12273)
      $box.css(css);
    }
    $box.dequeue().animate(css, {
      duration: speed,
      complete: function () {
        modalDimensions(this);
        
        active = false;
        
        // shrink the wrapper down to exactly the size of colorbox to avoid a bug in IE's iframe implementation.
        $wrap[0].style.width = (settings.w + loadedWidth + interfaceWidth) + "px";
        $wrap[0].style.height = (settings.h + loadedHeight + interfaceHeight) + "px";
        
        if (settings.reposition) {
          setTimeout(function () {  // small delay before binding onresize due to an IE8 bug.
            $window.bind('resize.' + prefix, publicMethod.position);
          }, 1);
        }

        if (loadedCallback) {
          loadedCallback();
        }
      },
      step: function () {
        modalDimensions(this);
      }
    });
  };

  publicMethod.resize = function (options) {
    if (open) {
      options = options || {};
      
      if (options.width) {
        settings.w = setSize(options.width, 'x') - loadedWidth - interfaceWidth;
      }
      if (options.innerWidth) {
        settings.w = setSize(options.innerWidth, 'x');
      }
      $loaded.css({width: settings.w});
      
      if (options.height) {
        settings.h = setSize(options.height, 'y') - loadedHeight - interfaceHeight;
      }
      if (options.innerHeight) {
        settings.h = setSize(options.innerHeight, 'y');
      }
      if (!options.innerHeight && !options.height) {
        $loaded.css({height: "auto"});
        settings.h = $loaded.height();
      }
      $loaded.css({height: settings.h});
      
      publicMethod.position(settings.transition === "none" ? 0 : settings.speed);
    }
  };

  publicMethod.prep = function (object) {
    if (!open) {
      return;
    }
    
    var callback, speed = settings.transition === "none" ? 0 : settings.speed;

    $loaded.empty().remove(); // Using empty first may prevent some IE7 issues.

    $loaded = $tag(div, 'LoadedContent').append(object);
    
    function getWidth() {
      settings.w = settings.w || $loaded.width();
      settings.w = settings.mw && settings.mw < settings.w ? settings.mw : settings.w;
      return settings.w;
    }
    function getHeight() {
      settings.h = settings.h || $loaded.height();
      settings.h = settings.mh && settings.mh < settings.h ? settings.mh : settings.h;
      return settings.h;
    }
    
    $loaded.hide()
    .appendTo($loadingBay.show())// content has to be appended to the DOM for accurate size calculations.
    .css({width: getWidth(), overflow: settings.scrolling ? 'auto' : 'hidden'})
    .css({height: getHeight()})// sets the height independently from the width in case the new width influences the value of height.
    .prependTo($content);
    
    $loadingBay.hide();
    
    // floating the IMG removes the bottom line-height and fixed a problem where IE miscalculates the width of the parent element as 100% of the document width.
    
    $(photo).css({'float': 'none'});

    callback = function () {
      var total = $related.length,
        iframe,
        frameBorder = 'frameBorder',
        allowTransparency = 'allowTransparency',
        complete;
      
      if (!open) {
        return;
      }
      
      function removeFilter() {
        if (isIE) {
          $box[0].style.removeAttribute('filter');
        }
      }
      
      complete = function () {
        clearTimeout(loadingTimer);
        $loadingOverlay.hide();
        trigger(event_complete, settings.onComplete);
      };
      
      if (isIE) {
        //This fadeIn helps the bicubic resampling to kick-in.
        if (photo) {
          $loaded.fadeIn(100);
        }
      }
      
      $title.html(settings.title).add($loaded).show();
      
      if (total > 1) { // handle grouping
        if (typeof settings.current === "string") {
          $current.html(settings.current.replace('{current}', index + 1).replace('{total}', total)).show();
        }
        
        $next[(settings.loop || index < total - 1) ? "show" : "hide"]().html(settings.next);
        $prev[(settings.loop || index) ? "show" : "hide"]().html(settings.previous);
        
        if (settings.slideshow) {
          $slideshow.show();
        }
        
        // Preloads images within a rel group
        if (settings.preloading) {
          $.each([getIndex(-1), getIndex(1)], function(){
            var src,
              img,
              i = $related[this],
              data = $.data(i, colorbox);

            if (data && data.href) {
              src = data.href;
              if ($.isFunction(src)) {
                src = src.call(i);
              }
            } else {
              src = $(i).attr('href');
            }

            if (src && isImage(data, src)) {
              src = retinaUrl(data, src);
              img = new Image();
              img.src = src;
            }
          });
        }
      } else {
        $groupControls.hide();
      }
      
      if (settings.iframe) {
        iframe = $tag('iframe')[0];
        
        if (frameBorder in iframe) {
          iframe[frameBorder] = 0;
        }
        
        if (allowTransparency in iframe) {
          iframe[allowTransparency] = "true";
        }

        if (!settings.scrolling) {
          iframe.scrolling = "no";
        }
        
        $(iframe)
          .attr({
            src: settings.href,
            name: (new Date()).getTime(), // give the iframe a unique name to prevent caching
            'class': prefix + 'Iframe',
            allowFullScreen : true, // allow HTML5 video to go fullscreen
            webkitAllowFullScreen : true,
            mozallowfullscreen : true
          })
          .one('load', complete)
          .appendTo($loaded);
        
        $events.one(event_purge, function () {
          iframe.src = "//about:blank";
        });

        if (settings.fastIframe) {
          $(iframe).trigger('load');
        }
      } else {
        complete();
      }
      
      if (settings.transition === 'fade') {
        $box.fadeTo(speed, 1, removeFilter);
      } else {
        removeFilter();
      }
    };
    
    if (settings.transition === 'fade') {
      $box.fadeTo(speed, 0, function () {
        publicMethod.position(0, callback);
      });
    } else {
      publicMethod.position(speed, callback);
    }
  };

  publicMethod.load = function (launched) {
    var href, setResize, prep = publicMethod.prep, $inline, request = ++requests;
    
    active = true;
    
    photo = false;
    
    element = $related[index];
    
    if (!launched) {
      makeSettings();
    }

    if (className) {
      $box.add($overlay).removeClass(className);
    }
    if (settings.className) {
      $box.add($overlay).addClass(settings.className);
    }
    className = settings.className;
    
    trigger(event_purge);
    
    trigger(event_load, settings.onLoad);
    
    settings.h = settings.height ?
        setSize(settings.height, 'y') - loadedHeight - interfaceHeight :
        settings.innerHeight && setSize(settings.innerHeight, 'y');
    
    settings.w = settings.width ?
        setSize(settings.width, 'x') - loadedWidth - interfaceWidth :
        settings.innerWidth && setSize(settings.innerWidth, 'x');
    
    // Sets the minimum dimensions for use in image scaling
    settings.mw = settings.w;
    settings.mh = settings.h;
    
    // Re-evaluate the minimum width and height based on maxWidth and maxHeight values.
    // If the width or height exceed the maxWidth or maxHeight, use the maximum values instead.
    if (settings.maxWidth) {
      settings.mw = setSize(settings.maxWidth, 'x') - loadedWidth - interfaceWidth;
      settings.mw = settings.w && settings.w < settings.mw ? settings.w : settings.mw;
    }
    if (settings.maxHeight) {
      settings.mh = setSize(settings.maxHeight, 'y') - loadedHeight - interfaceHeight;
      settings.mh = settings.h && settings.h < settings.mh ? settings.h : settings.mh;
    }
    
    href = settings.href;
    
    loadingTimer = setTimeout(function () {
      $loadingOverlay.show();
    }, 100);
    
    if (settings.inline) {
      // Inserts an empty placeholder where inline content is being pulled from.
      // An event is bound to put inline content back when ColorBox closes or loads new content.
      $inline = $tag(div).hide().insertBefore($(href)[0]);

      $events.one(event_purge, function () {
        $inline.replaceWith($loaded.children());
      });

      prep($(href));
    } else if (settings.iframe) {
      // IFrame element won't be added to the DOM until it is ready to be displayed,
      // to avoid problems with DOM-ready JS that might be trying to run in that iframe.
      prep(" ");
    } else if (settings.html) {
      prep(settings.html);
    } else if (isImage(settings, href)) {

      href = retinaUrl(settings, href);

      $(photo = new Image())
      .addClass(prefix + 'Photo')
      .bind('error',function () {
        settings.title = false;
        prep($tag(div, 'Error').html(settings.imgError));
      })
      .one('load', function () {
        var percent;

        if (request !== requests) {
          return;
        }

        if (settings.retinaImage && window.devicePixelRatio > 1) {
          photo.height = photo.height / window.devicePixelRatio;
          photo.width = photo.width / window.devicePixelRatio;
        }

        if (settings.scalePhotos) {
          setResize = function () {
            photo.height -= photo.height * percent;
            photo.width -= photo.width * percent;
          };
          if (settings.mw && photo.width > settings.mw) {
            percent = (photo.width - settings.mw) / photo.width;
            setResize();
          }
          if (settings.mh && photo.height > settings.mh) {
            percent = (photo.height - settings.mh) / photo.height;
            setResize();
          }
        }
        
        if (settings.h) {
          photo.style.marginTop = Math.max(settings.mh - photo.height, 0) / 2 + 'px';
        }
        
        if ($related[1] && (settings.loop || $related[index + 1])) {
          photo.style.cursor = 'pointer';
          photo.onclick = function () {
            publicMethod.next();
          };
        }
        
        if (isIE) {
          photo.style.msInterpolationMode = 'bicubic';
        }
        
        setTimeout(function () { // A pause because Chrome will sometimes report a 0 by 0 size otherwise.
          prep(photo);
        }, 1);
      });
      
      setTimeout(function () { // A pause because Opera 10.6+ will sometimes not run the onload function otherwise.
        photo.src = href;
      }, 1);
    } else if (href) {
      $loadingBay.load(href, settings.data, function (data, status) {
        if (request === requests) {
          prep(status === 'error' ? $tag(div, 'Error').html(settings.xhrError) : $(this).contents());
        }
      });
    }
  };
    
  // Navigates to the next page/image in a set.
  publicMethod.next = function () {
    if (!active && $related[1] && (settings.loop || $related[index + 1])) {
      index = getIndex(1);
      publicMethod.load();
    }
  };
  
  publicMethod.prev = function () {
    if (!active && $related[1] && (settings.loop || index)) {
      index = getIndex(-1);
      publicMethod.load();
    }
  };

  // Note: to use this within an iframe use the following format: parent.$.fn.colorbox.close();
  publicMethod.close = function () {
    if (open && !closing) {
      
      closing = true;
      
      open = false;
      
      trigger(event_cleanup, settings.onCleanup);
      
      $window.unbind('.' + prefix + ' .' + event_ie6);
      
      $overlay.fadeTo(200, 0);
      
      $box.stop().fadeTo(300, 0, function () {
      
        $box.add($overlay).css({'opacity': 1, cursor: 'auto'}).hide();
        
        trigger(event_purge);
        
        $loaded.empty().remove(); // Using empty first may prevent some IE7 issues.
        
        setTimeout(function () {
          closing = false;
          trigger(event_closed, settings.onClosed);
        }, 1);
      });
    }
  };

  // Removes changes ColorBox made to the document, but does not remove the plugin
  // from jQuery.
  publicMethod.remove = function () {
    $([]).add($box).add($overlay).remove();
    $box = null;
    $('.' + boxElement)
      .removeData(colorbox)
      .removeClass(boxElement);

    $(document).unbind('click.'+prefix);
  };

  // A method for fetching the current element ColorBox is referencing.
  // returns a jQuery object.
  publicMethod.element = function () {
    return $(element);
  };

  publicMethod.settings = defaults;

}(jQuery, document, window));

