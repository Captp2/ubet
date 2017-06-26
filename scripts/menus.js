"use strict";
function showMenu(e){
	var menu = $('#' + e.dataset.target);
	menu.fadeIn();
}

function hideMenu(e){
	var menus = $('.menus');
	menus.fadeOut();
}

$(document).on('keypress', function(elem){
	if(elem.keyCode == 27){
		hideMenu();
	}
})

function hideMe(e){
	$(e).parent().fadeOut();
}

function adminEvents(e){
	$('#admin-users').fadeOut(100);
	$('#admin-teams').fadeOut(100);
	$(e).stop().animate({width: "80%"});
	$(e).css('cursor', 'default');
	$('.admin-header').hide();
	$('.admin-body').show();
	$(e).attr("onclick","");
}

function adminUsers(e){
	$('#admin-events').fadeOut(100);
	$('#admin-teams').fadeOut(100);
	$(e).stop().animate({width: "80%"});
	$(e).css('cursor', 'default');
	$('.admin-header').hide();
	$('.admin-body').show();
	$(e).attr("onclick","");
}

function adminTeams(e){
	$('#admin-users').fadeOut(100);
	$('#admin-events').fadeOut(100);
	$(e).stop().animate({width: "80%"});
	$(e).css('cursor', 'default');
	$('.admin-header').hide();
	$('.admin-body').show();
	$(e).attr("onclick","");
}

function selectTeam(e){
	var teamName = $(e).val();
	console.log($(e).attr('name'));
	console.log($(e).val());
	if($(e).attr('name') == 'team_a'){
		var options = $('#team_b').children();
		console.log(options);
		options.forEach(function(elem){
			if(elem.attr('name') == teamName){
				console.log('BLAAAAAAAAAAH');
			}
		})
	}
}