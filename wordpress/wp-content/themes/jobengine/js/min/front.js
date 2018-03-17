JobEngine.Models.Auth=Backbone.Model.extend({params:{type:"POST",dataType:"json",url:et_globals.ajaxURL,contentType:"application/x-www-form-urlencoded;charset=UTF-8"},setUserName:function(e){this.set({user_name:e},{silent:true})},setEmail:function(e){this.set({user_email:e},{silent:true})},setPass:function(e){this.set({user_pass:e},{silent:true})},setUserKey:function(e){this.set({user_key:e},{silent:true})},changePassword:function(e){var t=_.extend({data:{action:"et_change_pass",user_old_pass:this.get("user_old_pass"),user_pass:this.get("user_pass"),user_pass_again:this.get("user_pass_again")}},this.params,e||{});t.beforeSend=function(){pubsub.trigger("je:request:waiting");if(e&&typeof e.beforeSend==="function"){e.beforeSend()}};t.success=function(t,n,r){pubsub.trigger("je:response:changePassword",t,n,r);if(e&&typeof e.success==="function"){e.success(t,n,r)}};t.error=function(t,n,r){pubsub.trigger("je:notification",{msg:n,notice_type:"error"});if(e&&typeof e.error==="function"){e.error(t,n,r)}};return jQuery.ajax(t)},doAuth:function(e,t){var n;if(e==="login"){this.unset("user_pass_again",{silent:true});e="et_login"}else if(e==="register"){e="et_register"}else{return false}n=_.extend({data:{action:e,user_email:this.get("user_email"),user_pass:this.get("user_pass"),user_name:this.get("user_name")}},this.params,t||{});if(t&&"renew_logo_nonce"in t&&!!t.renew_logo_nonce){n.data.renew_logo_nonce=true}n.beforeSend=function(){pubsub.trigger("je:request:waiting");if(t&&typeof t.beforeSend==="function"){t.beforeSend()}};n.success=function(e,n,r){pubsub.trigger("je:response:auth",e,n,r);if(t&&typeof t.success==="function"){t.success(e,n,r)}};n.error=function(e,n,r){pubsub.trigger("je:notification",{msg:n,notice_type:"error"});if(t&&typeof t.error==="function"){t.error(e,n,r)}};return jQuery.ajax(n)},doLogout:function(e){var t=_.extend({data:{action:"et_logout"}},this.params,e||{});if(e&&typeof e.beforeSend==="function"){t.beforeSend=e.beforeSend}t.success=function(t,n,r){pubsub.trigger("je:response:logout",t,n,r);if(e&&typeof e.success==="function"){e.success(t,n,r)}};return jQuery.ajax(t)},doResetPassword:function(e){var t=_.extend({data:{action:"et_reset_password",user_login:this.get("user_name"),user_pass:this.get("user_pass"),user_key:this.get("user_key")}},this.params,e||{});t.beforeSend=function(){pubsub.trigger("je:request:waiting");if(e&&typeof e.beforeSend==="function"){e.beforeSend()}};t.success=function(t,n,r){pubsub.trigger("je:response:reset_password",t,n,r);if(e&&typeof e.success==="function"){e.success(t,n,r)}};return jQuery.ajax(t)},doRequestResetPassword:function(e){var t=_.extend({data:{action:"et_request_reset_password",user_login:this.get("user_email")}},this.params,e||{});t.beforeSend=function(){pubsub.trigger("je:request:requestResetPassWaiting");if(e&&typeof e.beforeSend==="function"){e.beforeSend()}};t.success=function(t,n,r){pubsub.trigger("je:response:request_reset_password",t,n,r);if(e&&typeof e.success==="function"){e.success(t,n,r)}};return jQuery.ajax(t)}});JobEngine.Views.App=Backbone.View.extend({el:jQuery("body"),header:{},templates:{},currentUser:{},auth:{},initialize:function(){$.validator.setDefaults({onsubmit:false,onfocusout:function(e,t){if(!this.checkable(e)&&e.tagName.toLowerCase()==="textarea"){this.element(e)}else if(!this.checkable(e)&&(e.name in this.submitted||!this.optional(e))){this.element(e)}},validClass:"valid",errorClass:"message",errorElement:"div",errorPlacement:function(e,t){$(t).closest("div").append(e)},highlight:function(e,t,n){var r=$(e).closest("div");if(!r.hasClass("error")){r.addClass("error").removeClass(n).append('<span class="icon" data-icon="!"></span>')}},unhighlight:function(e,t,n){var r=$(e).closest("div");if(r.hasClass("error")){r.removeClass("error").addClass(n)}r.find("div.message").remove().end().find("span.icon").remove()}});this.header=new JobEngine.Views.Header;this.auth=new JobEngine.Models.Auth;var e=this.$("#current_user_data").html();if(!!e){e=JSON.parse(e)}this.currentUser=new JobEngine.Models.Company(e);this.templates.notification=new _.template('<div class="notification autohide <%= type %>-bg">'+'<div class="main-center">'+"<%= msg %>"+"</div>"+"</div>");pubsub.on("je:notification",this.showNotice,this);pubsub.on("je:response:auth",this.handleAuth,this);pubsub.on("je:response:request_reset_password",this.handleRequestResetPassword,this);pubsub.on("je:response:reset_password",this.handleResetPassword,this);pubsub.on("je:response:logout",this.handleLogout,this);this.currentUser.on("change:id",this.header.updateAuthButtons,this.header)},showNotice:function(e){jQuery("div.notification").remove();var t=jQuery(this.templates.notification({msg:e.msg,type:e.notice_type}));if(jQuery("#wpadminbar").length!==0){t.addClass("having-adminbar")}t.hide().prependTo("body").fadeIn("fast").delay(1e3).fadeOut(3e3,function(){jQuery(this).remove()})},handleAuth:function(e,t,n){var r;if(e.status){pubsub.trigger("je:notification",{msg:e.msg,notice_type:"success"});if(typeof et_post_job==="undefined"){window.location.reload()}this.currentUser.set(e.data)}else{pubsub.trigger("je:notification",{msg:e.msg,notice_type:"error"})}},handleRequestResetPassword:function(e,t,n){pubsub.trigger("je:notification",{notice_type:e.success?"success":"error",msg:e.msg})},handleResetPassword:function(e,t,n){pubsub.trigger("je:notification",{notice_type:e.success?"success":"error",msg:e.msg})},handleLogout:function(e,t,n){this.currentUser.clear();pubsub.trigger("je:notification",{msg:e.msg,notice_type:"success"});if(typeof et_post_job==="undefined"){window.location.href=et_globals.homeURL}}});JobEngine.Views.Header=Backbone.View.extend({el:jQuery("header"),modal_login:{},modal_register:{},modal_forgot_pass:{},templates:{login:'<li><a id="requestLogin" class="login-modal header-btn" href="#login"><span class="icon" data-icon="U"></span></a></li>',auth:'<li><a href="'+et_globals.dashboardURL+'" class="header-btn"><span class="icon" data-icon="U"></span></a></li>'+'<li><a href="'+et_globals.logoutURL+'" id="requestLogout" class="header-btn"><span class="icon" data-icon="Q"></span></a></li>'},events:{"click a#requestLogout":"doLogout","click a#requestLogin":"doLogin","click a#requestRegister":"doRegister"},initialize:function(){if(!this.modal_login||!(this.modal_login instanceof JobEngine.Views.Modal_Login)){this.modal_login=new JobEngine.Views.Modal_Login}if(!this.modal_register||!(this.modal_register instanceof JobEngine.Views.Modal_Register)){this.modal_register=new JobEngine.Views.Modal_Register}if(!this.modal_forgot_pass||!(this.modal_forgot_pass instanceof JobEngine.Views.Modal_Forgot_Pass)){this.modal_forgot_pass=new JobEngine.Views.Modal_Forgot_Pass}},updateAuthButtons:function(){if(!JobEngine.app.currentUser.isNew()){this.$("div.account ul").html(this.templates.auth)}else{this.$("div.account ul").html(this.templates.login)}},doLogout:function(e){e.preventDefault();pubsub.trigger("je:request:logout");JobEngine.app.auth.doLogout()},doLogin:function(e){e.preventDefault();pubsub.trigger("je:request:auth")},doRegister:function(e){e.preventDefault();pubsub.trigger("je:request:register")}});JobEngine.Views.JobListView=Backbone.View.extend({tagName:"div",className:"jobs_container",initialize:function(){var e=this;_.bindAll(this);this.listConfig=_.extend({disableAction:false},{disableAction:this.options.disableAction});this.listView=[];if(!!this.collection&&!!this.el){this.collection.each(function(t,n,r){var i=e.$("li:eq("+n+")");if(i.length!==0){e.listView[n]=new JobEngine.Views.JobListItemView({el:i,model:t,listConfig:e.listConfig})}})}this.collection.on("add",this.addJob,this);this.collection.on("unshift",this.addJob,this);this.collection.on("remove",this.removeJob,this);this.collection.on("reset",this.render,this);this.collection.bind("nextPageBeforeSend",this.nextPageBeforeSend);this.collection.bind("nextPageSuccess",this.nextPageSuccess);this.collection.bind("filterBeforeSend",this.filterBeforeSend);this.collection.bind("filterSuccess",this.filterSuccess);this.blockUi=new JobEngine.Views.BlockUi({image:et_globals.imgURL+"/loading_big.gif",opacity:.7,background_color:$("body").css("background-color")})},addJob:function(e,t,n){var r=new JobEngine.Views.JobListItemView({model:e,listConfig:this.listConfig}),i=r.render().$el.hide(),s=this.$("li.job-item"),o=n&&"index"in n?n.index:s.length,u=s.eq(o);if(this.listView.length===0||u.length===0){i.appendTo(this.$el.find("ul")).fadeIn("slow")}else{i.insertBefore(u).fadeIn("slow")}this.listView.splice(o,0,r)},removeJob:function(e,t,n){var r=this.listView.splice(n.index,1);if(r.length>0){r[0].$el.fadeOut("slow",function(){r[0].remove().undelegateEvents();pubsub.trigger("je:job:afterRemoveJobView",e)})}},render:function(){var e=this.$el.find("ul"),t=e.children(),n=this,r=t.length;if(this.collection.length>0){e.fadeOut("fast");_.each(this.listView,function(e){e.remove().undelegateEvents()});if(r!==0){t.fadeOut("normal",function(){jQuery(this).remove();r--;if(r===0){n.collection.each(n.addJob)}})}else{this.collection.each(this.addJob)}this.$(".main-title").html(this.collection.list_title);e.fadeIn("slow")}else{e.html("").append('<li class="no-job-found">'+et_globals.no_job_found+"</li>")}if(this.collection.paginateData.paged>=this.collection.paginateData.total_pages){this.$("div.button-more").hide()}else{this.$("div.button-more").fadeIn("slow")}return this},nextPageBeforeSend:function(){this.loadingBtn=new JobEngine.Views.LoadingButton({el:this.$(".button-more button")});this.loadingBtn.loading()},nextPageSuccess:function(){this.loadingBtn.finish()},filterBeforeSend:function(){this.blockUi.block(this.$el.find("ul"))},filterSuccess:function(){this.blockUi.unblock()}});JobEngine.Views.JobListItemView=Backbone.View.extend({tagName:"li",className:"job-item",events:{"click .actions .action-featured":"toggleFeature","click .actions .action-approve":"approveJob","click .actions .action-reject":"rejectJob","click .actions .action-archive":"archiveJob","click .actions .action-edit":"editJob"},isProcessing:false,initialize:function(){if(this.model){pubsub.on("je:job:onAuthorChanged:"+this.model.get("author_id"),this.renderAuthor,this);this.model.on("change",this.render,this)}this.blockUi=new JobEngine.Views.BlockUi},render:function(){var e=this,t=this.model.toJSON();this.template=jQuery("#job_list_item");if(this.template.length>0){this.template=_.template(this.template.html())}if(this.model.author.has("user_logo")&&this.model.author.has("post_url")&&this.model.author.has("display_name")){this.model.updateJobAuthor();this.$el.addClass("job-item").html(this.template($.extend({},this.model.toJSON(),this.options.listConfig)))}else{this.model.author.fetch({silent:true,success:function(t,n){e.model.set("author_data",{id:t.get("id"),user_url:t.get("user_url"),display_name:t.get("display_name"),user_logo:t.get("user_logo"),post_url:t.get("post_url")},{silent:true});e.$el.addClass("job-item").html(e.template($.extend({},e.model.toJSON(),e.options.listConfig)))}})}return this},blockItem:function(){this.blockUi.block(this.$el)},unblockItem:function(){this.blockUi.unblock()},renderAuthor:function(e){var t=this.$(".thumb").empty(),n=this.$(".content .company_name"),r="small_thumb"in e["user_logo"]?e["user_logo"]["small_thumb"][0]:e["user_logo"]["thumbnail"][0],i="<a data='"+e["id"]+"' href='"+e["post_url"]+"' "+"id='job_author_name' class='thumb' title='"+e["display_name"]+"'>";t.html(i+"<img src='"+r+"' alt='"+e["display_name"]+"'/></a>");n.html(i+e["display_name"]+"</a>")},toggleFeature:function(e){var t=this;e.preventDefault();this.model.save({},{data:{id:this.model.id},method:"toggleFeature",beforeSend:function(){t.blockItem()},success:function(e,n){t.unblockItem();if(n.success){pubsub.trigger("je:job:afterToggleFeature",e,n);pubsub.trigger("je:notification",{msg:n.msg,notice_type:"success"})}}})},approveJob:function(e){e.preventDefault();var t=this;this.model.approve({silent:true,beforeSend:function(){t.blockItem()},success:function(){t.unblockItem()}})},rejectJob:function(e){e.preventDefault();pubsub.trigger("je:job:onReject",{model:this.model,itemView:this})},archiveJob:function(e){var t=this;e.preventDefault();this.model.archive({silent:true,beforeSend:function(){t.blockItem()},success:function(){t.unblockItem()}})},editJob:function(e){e.preventDefault();if(!this.model.has("id")){this.model.set("id",this.model.get("id"),{silent:true})}pubsub.trigger("je:job:onEdit",this.model)}});JobEngine.Views.Modal_Edit_Job=JobEngine.Views.Modal_Box.extend({el:jQuery("div#modal_edit_job"),events:{"click div.modal-close":"closeModal","keypress input#full_location":"geocoding","blur input#full_location":"resetLocation","submit form#job_form":"submitForm"},initialize:function(){JobEngine.Views.Modal_Box.prototype.initialize.apply(this,arguments);var e=this,t=this.$("#user_logo_container");_.bindAll(this);tinyMCE.execCommand("mceAddControl",false,"content");var n=new JobEngine.Views.BlockUi;this.logo_uploader=new JobEngine.Views.File_Uploader({el:t,uploaderID:"user_logo",thumbsize:"company-logo",multipart_params:{_ajax_nonce:t.find(".et_ajaxnonce").attr("id"),action:"et_logo_upload"},cbUploaded:function(t,n,r){if(r.success){e.model.author.set("user_logo",r.data,{silent:true})}else{pubsub.trigger("je:notification",{msg:r.msg,notice_type:"error"})}},beforeSend:function(e){n.block(t.find(".thumbs"))},success:function(){n.unblock()}});pubsub.on("je:job:afterEditJob",this.closeModal,this);this.bind("waiting",this.waiting,this);this.bind("endWaiting",this.endWaiting,this)},onEdit:function(e,t){t=t||null;if(e instanceof JobEngine.Models.Job&&e.has("id")&&(!(this.model instanceof JobEngine.Models.Job)||!this.model.has("id")||this.model.id!==e.id)){this.model=e}else{if(!this.model.has("id")){pubsub.trigger("je:notification",{msg:"Invalid Job ID",notice_type:"error"})}}if(!(this.model.has("id")&&this.model.has("author_id")&&this.model.has("title")&&this.model.has("content")&&this.model.has("location")&&this.model.has("categories")&&this.model.has("job_types"))){this.model.fetch({silent:true,success:this.setupFieldsAndOpenModal})}else{if(!(this.model.author.has("display_name")&&this.model.author.has("user_url")&&this.model.author.has("user_logo"))){if(t!==null){this.model.author.set(t,{silent:true});this.setupFieldsAndOpenModal()}else{this.model.author.set("id",this.model.get("author_id"),{silent:true});this.model.author.fetch({silent:true,success:this.setupFieldsAndOpenModal})}}else{this.setupFieldsAndOpenModal()}}},setupFieldsAndOpenModal:function(){var e=this;this.logo_uploader.updateConfig({multipart_params:{author:this.model.author.get("id")},updateThumbnail:true,data:this.model.author.get("user_logo")});this.setupFields(this.model);this.model.set("prev_cats",jQuery.map(this.model.get("categories"),function(e,t){return e.slug}),{silent:true});this.model.set("prev_status",this.model.get("status"),{silent:true});this.openModal();this.initMap();this.initValidator();this.validator.resetForm();if(typeof this.map.refresh==="function"){this.map.refresh();if(this.model.has("location_lat")&&this.model.has("location_lng")){GMaps.geocode({lat:this.model.get("location_lat"),lng:this.model.get("location_lng"),callback:function(t,n){if(n=="OK"){var r=t[0].geometry.location;e.map.setCenter(r.lat(),r.lng());e.map.markers=[];e.map.addMarker({lat:r.lat(),lng:r.lng(),draggable:true,dragend:function(t){e.$("#location_lat").val(t.position.Xa);e.$("#location_lng").val(t.position.Ya)}});e.$("#location_lat").val(r.lat());e.$("#location_lng").val(r.lng())}}})}}},initMap:function(){if(typeof this.map==="undefined"){this.map=new GMaps({div:"#map",lat:10.7966064,lng:106.6902172,zoom:12,panControl:false,zoomControl:false,mapTypeControl:false})}},initValidator:function(){if(typeof this.validator==="undefined"){this.validator=this.$("form#job_form").validate({ignore:"select, .plupload input",rules:{title:"required",location:"required",content:"required",display_name:"required",user_url:{required:true,url:true}}})}},setupFields:function(e){var t=this.$("div#job-details"),n=this.$("div#company-details"),r=e.get("job_types"),i=e.get("categories"),s=e.get("status"),o=t.find("select#job_status"),u,a;if(_.isArray(r)&&"slug"in r[0]){u=r[0].slug}if(_.isArray(i)&&"slug"in i[0]){a=i[0].slug}t.find("input#title").val(e.get("title")).end().find("input#location").val(e.get("location")).end().find("input#full_location").val(e.get("full_location")).end().find("select#job_types").val(u).change().end().find("select#categories").val(a).change();if(o.length!==0){o.val(s).change()}setTimeout(function(){tinyMCE.get("content").setContent(e.get("content"))},100);n.find("input#display_name").val(e.author.get("display_name")).end().find("input#user_url").val(e.author.get("user_url"))},geocoding:function(e){var t=this,n=$(e.currentTarget);if(typeof this.t!=="undefined"){clearTimeout(this.t)}this.t=setTimeout(function(){GMaps.geocode({address:n.val().trim(),callback:function(e,n){if(n==="OK"){var r=e[0].geometry.location;t.map.setCenter(r.lat(),r.lng());t.map.removeMarkers();t.map.addMarker({lat:r.lat(),lng:r.lng(),draggable:true,dragend:function(e){t.$("#location_lat").val(e.position.Xa);t.$("#location_lng").val(e.position.Ya)}});t.$("#location_lat").val(r.lat());t.$("#location_lng").val(r.lng())}}})},500)},resetLocation:function(e){var t=$(e.currentTarget),n=this.$("#location_lat").val(),r=this.$("#location_lng").val(),i=this.$("#location");GMaps.geocode({lat:n,lng:r,callback:function(e,n){if(n=="OK"){var r=e[0].address_components.length,s=e[0].address_components,o=e[0].formatted_address,u=" ",a=" ",f;for(f=0;f<r;f++){if(s[f].types[0]=="administrative_area_level_2"&&s[f].long_name!=="undefined"){u=s[f].long_name+", "}if(s[f].types[0]=="administrative_area_level_1"&&s[f].long_name!=="undefined"){a=s[f].long_name}}i.val(u+a);t.val(o)}}})},waiting:function(){this.title=this.$el.find("#submit-form").val();this.$el.find("#submit-form").val(et_globals.loading)},endWaiting:function(){this.$el.find("#submit-form").val(this.title)},submitForm:function(e){e.preventDefault();var t={},n={},r=this.$("div#job-details"),i=this.$("div#company-details"),s=r.find("select#job_status"),o=this;if(this.validator.form()){i.find("input").each(function(){var e=jQuery(this);n[e.attr("id")]=e.val()});this.model.author.set(n);r.find("input,textarea").each(function(){var e=jQuery(this);t[e.attr("id")]=e.val()});t["job_types"]=[{slug:r.find("select#job_types").val()}];t["categories"]=[{slug:r.find("select#categories").val()}];if(s.length!==0){t["status"]=s.val()}var u=new JobEngine.Views.LoadingButton({el:this.$el.find("#submit-form")});this.model.set(t,{silent:true}).save({},{wait:true,author_sync:true,beforeSend:function(){u.loading()},success:function(e,t){u.finish();if(t.success){pubsub.trigger("je:job:afterEditJob",e);pubsub.trigger("je:notification",{msg:t.msg,notice_type:"success"});pubsub.trigger("je:job:onAuthorChanged:"+e.author.get("id"),e.author.toJSON())}else{pubsub.trigger("je:notification",{msg:t.msg,notice_type:"error"})}}})}}});JobEngine.Views.Modal_Login=JobEngine.Views.Modal_Box.extend({el:jQuery("#modal_login"),events:{"click div.modal-close":"closeModal","click a.cancel-modal":"closeModal","submit form#login":"doLogin","click a.forgot-pass-link":"openForgotPassword"},initialize:function(){JobEngine.Views.Modal_Box.prototype.initialize.apply(this,arguments);this.options=_.extend(this.options,this.defaults);this.initValidator();this.title=this.$el.find("input#submit_login").val();pubsub.on("je:request:auth",this.openModalAuth,this);pubsub.on("je:response:auth",this.afterLogin,this);this.bind("waiting",this.waiting,this);this.bind("endWaiting",this.endWaiting,this);this.loadingBtn=new JobEngine.Views.LoadingButton({el:this.$("input#submit_login")})},openModalAuth:function(){this.openModal();this.initValidator()},initValidator:function(){if(typeof this.validator==="undefined"){this.validator=this.$("form#login").validate({rules:{log_email:{required:true},log_pass:"required"}})}},waiting:function(){this.loadingBtn.loading()},endWaiting:function(){this.loadingBtn.finish()},doLogin:function(e){e.preventDefault();var t=this.$(e.currentTarget),n=t.closest("form"),r=t.attr("id"),i=this;if(this.validator.form()){JobEngine.app.auth.setUserName(t.find("input#log_email").val());JobEngine.app.auth.setEmail(t.find("input#log_email").val());JobEngine.app.auth.setPass(t.find("input#log_pass").val());JobEngine.app.auth.doAuth(r,{beforeSend:function(){i.trigger("waiting")}})}},afterLogin:function(e,t,n){this.trigger("endWaiting");if(e.status){this.closeModal()}else{}},openForgotPassword:function(e){e.preventDefault();this.closeModal(200,function(){pubsub.trigger("je:request:forgot_pass")})}});JobEngine.Views.Modal_Register=JobEngine.Views.Modal_Box.extend({el:jQuery("#modal-register"),events:{"click div.modal-close":"closeModal","submit form#register":"doRegister"},initialize:function(){JobEngine.Views.Modal_Box.prototype.initialize.apply(this,arguments);this.options=_.extend(this.options,this.defaults);pubsub.on("je:request:register",this.openModalRegister,this)},openModalRegister:function(){this.openModal();this.initValidator()},initValidator:function(){if(typeof this.validator==="undefined"){this.validator=this.$("form#register").validate({rules:{reg_name:"required",reg_email:{required:true,email:true},reg_pass:"required",reg_pass_again:{required:true,equalTo:"#reg_pass"}}})}},doRegister:function(e){e.preventDefault();if(this.validator.form()){JobEngine.app.auth.setUserName($container.find("input.is_user_name").val())}}});JobEngine.Views.Modal_Forgot_Pass=JobEngine.Views.Modal_Box.extend({el:jQuery("#modal-forgot-pass"),events:{"click div.modal-close":"closeModal","submit form#forgot_pass":"requestResetPassword"},initialize:function(){JobEngine.Views.Modal_Box.prototype.initialize.apply(this,arguments);this.options=_.extend(this.options,this.defaults);this.title=this.$el.find(".button > input.bg-btn-action").val();pubsub.on("je:request:forgot_pass",this.openModalPass,this);pubsub.on("je:response:request_reset_password",this.afterResetPassword,this);pubsub.on("je:request:requestResetPassWaiting",this.waiting,this);this.bind("endWaiting",this.endWaiting,this);this.loadingBtn=new JobEngine.Views.LoadingButton({el:this.$(".button > input.bg-btn-action")})},openModalPass:function(){this.openModal();this.initValidator()},initValidator:function(){if(typeof this.validator==="undefined"){this.validator=this.$("form#forgot_pass").validate({forgot_email:{required:true,email:true}})}},waiting:function(){this.loadingBtn.loading()},endWaiting:function(){this.loadingBtn.finish()},requestResetPassword:function(e){e.preventDefault();var t=this.$(e.currentTarget);if(this.validator.form()){JobEngine.app.auth.setEmail(t.find("input#forgot_email").val());JobEngine.app.auth.doRequestResetPassword()}},afterResetPassword:function(e,t){this.trigger("endWaiting");if(e.success)this.closeModal()}});jQuery(document).ready(function(e){JobEngine.app=new JobEngine.Views.App;var t=jQuery("body"),n=jQuery(".main-header"),r=jQuery(".header-filter"),i=jQuery(".wrapper");jQuery(".select-style select").each(function(){var e=jQuery(this),t=e.attr("title"),n=e.find("option:selected");if(n.val()!==""){t=n.text()}e.css({"z-index":10,opacity:0,"-khtml-appearance":"none"}).after('<span class="select">'+t+"</span>").change(function(){var e=jQuery("option:selected",this).text();jQuery(this).next().text(e)})});t.on("mouseenter",".tooltip",function(){var e=jQuery(this),t,n;this.tip=this.title;e.append('<div class="tooltip-wrapper">'+'<div class="tooltip-content">'+this.tip+"</div>"+'<div class="tooltip-btm"></div>'+"</div>");this.title="";this.width=e.width();n=e.find(".tooltip-wrapper");n.css({width:this.tip.length*8+15+"px"});n.css({left:this.width/2-n.width()/2+"px",top:-(n.height()+5)+"px"}).fadeIn(300)}).on("mouseleave",".tooltip",function(){jQuery(this).find(".tooltip-wrapper").fadeOut(50,function(){jQuery(this).remove()});this.title=this.tip});if(n.length>0){n.css({position:"fixed",top:n.offset().top+"px"});t.css({"margin-top":t.offset().top+n.height()+"px"})}if(r.length){r.css({position:"fixed",top:r.offset().top+"px"});t.css({"margin-top":t.offset().top+r.height()+"px"})}jQuery(".category-lists .sym-multi").click(function(){var e=jQuery(this);if(e.hasClass("sym-multi-expand")){e.removeClass("sym-multi-expand")}else{e.addClass("sym-multi-expand")}e.next("ul").slideToggle()});jQuery(".category-lists li a").each(function(){var e=jQuery(this);if(e.hasClass("active")){e.parents("ul").show()}});if(Modernizr&&!Modernizr.input.placeholder){jQuery("[placeholder]").each(function(){var e=jQuery(this);if(e.val()===""){e.val(e.attr("placeholder"))}}).focus(function(){var e=jQuery(this);if(e.val()===e.attr("placeholder")){e.val("");e.removeClass("placeholder")}}).blur(function(){var e=jQuery(this);if(e.val()===""||e.val()===e.attr("placeholder")){e.val(e.attr("placeholder"));e.addClass("placeholder")}}).closest("form").submit(function(){var e=jQuery(this);e.find("[placeholder]").each(function(){var e=jQuery(this);if(e.val()===e.attr("placeholder")){e.val("")}})})}i.css("min-height",i.height()+(jQuery(window).height()-jQuery("html").outerHeight(true)))})