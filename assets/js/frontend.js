(function($){
    'use strict';

    function typeText($el, fullText, options) {
        var idx = 0;
        var speed = options.speed || 70;
        var callback = options.callback || function(){};
        $el.html('');
        var cursor = $('<span class="elite-heading-typing-cursor">|</span>');
        $el.append(cursor);

        function step() {
            if (idx <= fullText.length) {
                $el.contents().filter(function(){ return this.nodeType === 3; }).remove();
                var textNode = document.createTextNode(fullText.substring(0, idx));
                $el[0].insertBefore(textNode, cursor[0]);
                idx++;
                setTimeout(step, speed);
            } else {
                callback();
            }
        }
        step();
    }

    function typeWhole($target, loop) {
        var fullText = $target.data('original');
        typeText($target, fullText, {
            speed: 90,
            callback: function(){
                if (loop) {
                    setTimeout(function(){
                        typeWhole($target, loop);
                    }, 900);
                }
            }
        });
    }

    function typeFirstWord($target, loop) {
        var fullText = $target.data('original');
        var words = fullText.trim().split(/\s+/);
        if (words.length === 0) return;
        var first = words.shift();
        var rest = words.join(' ');
        $target.html('');
        var spanFirst = $('<span class="elite-first"></span>');
        var spanRest = $('<span class="elite-rest"> ' + rest + '</span>');
        $target.append(spanFirst).append(spanRest);
        var cursor = $('<span class="elite-heading-typing-cursor">|</span>');
        spanFirst.append(cursor);

        typeText(spanFirst, first, {
            speed: 90,
            callback: function(){
                if (loop) {
                    setTimeout(function(){
                        typeFirstWord($target, loop);
                    }, 900);
                }
            }
        });
    }

    function typeLastWord($target, loop) {
        var fullText = $target.data('original');
        var words = fullText.trim().split(/\s+/);
        if (words.length === 0) return;
        var last = words.pop();
        var rest = words.join(' ');
        $target.html('');
        var spanRest = $('<span class="elite-rest">' + rest + ' </span>');
        var spanLast = $('<span class="elite-last"></span>');
        $target.append(spanRest).append(spanLast);
        var cursor = $('<span class="elite-heading-typing-cursor">|</span>');
        spanLast.append(cursor);

        typeText(spanLast, last, {
            speed: 90,
            callback: function(){
                if (loop) {
                    setTimeout(function(){
                        typeLastWord($target, loop);
                    }, 900);
                }
            }
        });
    }

    $(document).ready(function(){
        $('.elite-heading-title').each(function(){
            var $this = $(this);
            var typing = $this.data('typing') || 'none';
            var original = $this.html();
            $this.data('original', $('<div>').html(original).text());

            if (typing === 'none') {
                return;
            }

            if (typing === 'whole') {
                typeWhole($this, true);
            } else if (typing === 'first_word') {
                typeFirstWord($this, true);
            } else if (typing === 'last_word') {
                typeLastWord($this, true);
            }
        });
    });

})(jQuery);
