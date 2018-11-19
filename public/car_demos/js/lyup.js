! function(a) {
    'use strict';
    var defaults = {
            type: 0,
            shade: !0,
            shadeClose: !0,
            fixed: !0,
            anim: 'scale'
        },
        foo = {
            extend: function(opts) {
                var options = JSON.parse(JSON.stringify(defaults));
                for (var key in opts) options[key] = opts[key];
                return options
            },
            timer: {},
            end: {}
        },
        isArray = function(ary){  //判断是不是数组
            return Object.prototype.toString.call(ary)=='[object Array]';
        };
    foo.touch = function(a, b) {
        a.addEventListener("click", function(a) {
            b.call(this, a)  //意思是把 b 拿过来，并用 this 替换b ， 等于说继承了 b 的方法
        }, !1)
    };
    var num = 0,
        attrName = ['lyup-m-layer'],
        run = function(conf) {
            this.config = foo.extend(conf),this.view()
        };
    run.prototype = {
        view:function(){
            var conf = this.config;
            var el = document.createElement('div');
            this.id = el.id = attrName[0] + num;
            el.setAttribute('class', attrName[0] +' '+ attrName[0] + (''||0));
            el.setAttribute('index',num);

            var title = function(){
                var isAry = isArray(conf.title);
                var ret = conf.title ? '<div class="lyup-title" style="' + (isAry ? (conf.title[1] || '') : '') + '">' + (isAry ? conf.title[0] : conf.title) + '</div>' : '';
                return ret;
            }();
            var btns = function(){
                'string' == typeof conf.btn && (conf.btn = [conf.btn]);
                var a, btnLen = (conf.btn || []).length;
                var ret = 0 !== btnLen && conf.btn ? (a = '<span yes type="1" class="lyup-yes">' + conf.btn[0] + "</span>", 2 === btnLen && (a = '<span no type="0" class="lyup-no">' + conf.btn[1] + "</span>" + a), '<div class="lyup-btnbox">' + a + "</div>") : ""
                return ret;
            }();

            conf.type === 1 && (conf.shade = !1);
            el.innerHTML = (conf.shade ? '<div'+( 'string' == typeof conf.shade ? ' style="'+ conf.shade + '"' : '' )+' class="lyup-shade"></div>' : '')+'\
                <div class="lyup-container">\
                    <div class="lyup-section">\
                        <div class="lyup-main '+ 
                            (conf.type==1 ? 'lyup-main-msg ' : '') + 
                            (conf.className ? conf.className : '') +
                        ' lyup-ani-scale">\
                            '+title+'\
                            <div class="lyup-content">'+conf.content+'</div>\
                            '+btns+'\
                        </div>\
                    </div>\
                </div>';

            document.body.appendChild(el);
            var lybox = this.elem = document.querySelectorAll('#'+ this.id)[0];
            this.index = num++;
            this.action(conf,lybox);
        },
        action:function(conf,lybox){
            var _this = this;
            conf.time && (foo.timer[this.index] = setTimeout(function() {
                lyup.close(_this.index);
            }, 1e3 * conf.time));

            var btnfn = function() {
                var type = this.getAttribute('type');
                0 == type ? (conf.no && conf.no(), lyup.close(_this.index)) : conf.yes ? conf.yes(_this.index) : lyup.close(_this.index)
            };
            if (conf.btn)
                for (var allbtn = document.getElementsByClassName("lyup-btnbox")[0].children, len = allbtn.length, i = 0; len > i; i++) foo.touch(allbtn[i], btnfn);

            if (conf.shade && conf.shadeClose) {
                var mask = document.getElementsByClassName('lyup-shade')[0];
                foo.touch(mask, function() {
                    lyup.close(_this.index);
                });
            }
        }
    };
    a.lyup = {
        open:function(a){
            var b = new run(a || {});
            return b.index
        },
        close:function(num){
            var lybox = document.querySelectorAll('#'+attrName[0]+num)[0];
            lybox && (
                lybox.innerHTML = "", 
                document.body.removeChild(lybox), 
                clearTimeout(foo.timer[num]), 
                delete foo.timer[num]
            )
        },
        msg:function(con,t){
            lyup.open({
                content:con,
                type:1,
                time:t || 1.5
            })
        },
        alert:function(con,btn,fn){
            lyup.open({
                btn:btn
                ,content:con
                ,shadeClose:false
                ,yes:function(index){
                    fn(),lyup.close(index);
                }
            });
        },
        confirm:function(){
            var args = arguments;
            if(args.length>=4){
                lyup.open({
                    title:args[0]
                    ,btn:args[2]
                    ,content:args[1]
                    ,shadeClose:false
                    ,yes:function(index){
                        args[3](),lyup.close(index);
                    }
                })
            }else{
                lyup.open({
                    btn:args[1]
                    ,content:args[0]
                    ,shadeClose:false
                    ,yes:function(index){
                        args[2](),lyup.close(index);
                    }
                })
            }
        },
        prompt:function(){
            alert('暂无此方法');
        }
    };

    //加载css
    !function(){
        var a = document.scripts,
            b = a[a.length - 1],
            c = b.src,
            e = c.substring(0,c.lastIndexOf('/') + 1);
        b.getAttribute('merge') || document.head.appendChild(function(){
            var a = document.createElement('link');
            return a.href = e +  'need/lyup.css?1.0', a.type = 'text/css', a.rel = 'styleSheet', a.id = "lyupcss", a
        }());
    }();
}(window);


/*配置*/
/*
    var style = '\
        background-color:#ff6363;\
        color:#fff;\
    ';
    lyup.open({
        title:['我是标题',style]
        ,btn:['确定','取消']
        ,shade:'background-color:rgba(0,0,0,.7)'
        ,className:'hehe'
        ,content:'你这个人有毒呵呵哒'
        ,shadeClose:false
        ,yes:function(index){
            console.log('yes');
            lyup.close(index);
        }
        ,no:function(){
            console.log('no');
        }
    });

*/

/*使用*/
/*
    lyup.msg('呵呵哒');

    lyup.alert('内容','确定',function(){
        //code...
    });

    lyup.confirm('内容',['确定','取消'],function(){
        //code...
    });
    
    lyup.confirm('标题','内容',['确定','取消'],function(){
        //code...
    });
*/