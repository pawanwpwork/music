(function() {
  var e =
    /msie/i.test(navigator.userAgent) && !/opera/i.test(navigator.userAgent);
  var t = (window.soundcloud = {
    version: '0.1',
    debug: false,
    _listeners: [],
    _redispatch: function(e, t, n) {
      var r,
        i = this._listeners[e] || [],
        s = 'soundcloud:' + e;
      try {
        r = this.getPlayer(t);
      } catch (o) {
        if (this.debug && window.console) {
          console.error(
            'unable to dispatch widget event ' + e + ' for the widget id ' + t,
            n,
            o
          );
        }
        return;
      }
      if (window.jQuery) {
        jQuery(r).trigger(s, [n]);
      } else if (window.Prototype) {
        $(r).fire(s, n);
      } else {
      }
      for (var u = 0, a = i.length; u < a; u += 1) {
        i[u].apply(r, [r, n]);
      }
      if (this.debug && window.console) {
        console.log(s, e, t, n);
      }
    },
    addEventListener: function(e, t) {
      if (!this._listeners[e]) {
        this._listeners[e] = [];
      }
      this._listeners[e].push(t);
    },
    removeEventListener: function(e, t) {
      var n = this._listeners[e] || [];
      for (var r = 0, i = n.length; r < i; r += 1) {
        if (n[r] === t) {
          n.splice(r, 1);
        }
      }
    },
    getPlayer: function(t) {
      var n;
      try {
        if (!t) {
          throw 'The SoundCloud Widget DOM object needs an id atribute, please refer to SoundCloud Widget API documentation.';
        }
        n = e ? window[t] : document[t];
        if (n) {
          if (n.api_getFlashId) {
            return n;
          } else {
            throw "The SoundCloud Widget External Interface is not accessible. Check that allowscriptaccess is set to 'always' in embed code";
          }
        } else {
          throw 'The SoundCloud Widget with an id ' + t + " couldn't be found";
        }
      } catch (r) {
        if (console && console.error) {
          console.error(r);
        }
        throw r;
      }
    },
    onPlayerReady: function(e, t) {
      this._redispatch('onPlayerReady', e, t);
    },
    onMediaStart: function(e, t) {
      this._redispatch('onMediaStart', e, t);
    },
    onMediaEnd: function(e, t) {
      this._redispatch('onMediaEnd', e, t);
    },
    onMediaPlay: function(e, t) {
      this._redispatch('onMediaPlay', e, t);
    },
    onMediaPause: function(e, t) {
      this._redispatch('onMediaPause', e, t);
    },
    onMediaBuffering: function(e, t) {
      this._redispatch('onMediaBuffering', e, t);
    },
    onMediaSeek: function(e, t) {
      this._redispatch('onMediaSeek', e, t);
    },
    onMediaDoneBuffering: function(e, t) {
      this._redispatch('onMediaDoneBuffering', e, t);
    },
    onPlayerError: function(e, t) {
      this._redispatch('onPlayerError', e, t);
    }
  });
})();
