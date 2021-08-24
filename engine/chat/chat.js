var channels = ['tssuukiii'], // Channels to initially join
fadeDelay = 5000, // Set to false to disable chat fade
showChannel = true, // Show repespective channels if the channels is longer than 1
useColor = true, // Use chatters' colors or to inherit
showBadges = true, // Show chatters' badges
showEmotes = true, // Show emotes in the chat
doTimeouts = true, // Hide the messages of people who are timed-out
doChatClears = true, // Hide the chat from an entire channel
showHosting = true, // Show when the channel is hosting or not
showConnectionNotices = false; // Show messages like "Connected" and "Disconnected"

var randomColorsChosen = {};

if (!$.cookie('twitch_auth')) {
	var clientOptions = {
		options: {
			debug: true
		},
		connection: {
			reconnect: true,
			secure: true
		},
		channels: channels
	};
} else {
	json = jQuery.parseJSON($.cookie('twitch_auth'));
	var clientOptions = {
		options: {
			debug: true
		},
		connection: {
			reconnect: true,
			secure: true
		},
		identity: {
			username: 'tfboson',
			password: json.access_token
		},
		channels: channels
	};
	console.log(json.access_token);
}
var client = new tmi.client(clientOptions);




var twitchEmotes = {
	urlTemplate: 'http://static-cdn.jtvnw.net/emoticons/v1/{{id}}/{{image}}',
	scales: { 1: '1.0', 2: '2.0', 3: '3.0' }
};
var bttvEmotes = {
	urlTemplate: 'https://cdn.betterttv.net/emote/{{id}}/{{image}}',
	scales: { 1: '1x', 2: '2x', 3: '3x' },
	bots: [], // Bots listed by BTTV for a channel { name: 'name', channel: 'channel' }
	emoteCodeList: [], // Just the BTTV emote codes
	emotes: [], // BTTV emotes
	subEmotesCodeList: [], // I don't have a restriction set for Night-sub-only emotes, but the data's here.
	allowEmotesAnyChannel: true // Allow all BTTV emotes that are loaded no matter the channel restriction
};
var frankerz = {
	urlTemplate: 'https://cdn.frankerfacez.com/emote/{{id}}/{{image}}',
	scales: { 1: '1', 2: '2', 3: '2' },
	bots: [], // Bots listed by BTTV for a channel { name: 'name', channel: 'channel' }
	emoteCodeList: [], // Just the BTTV emote codes
	emotes: [], // BTTV emotes
	subEmotesCodeList: [], // I don't have a restriction set for Night-sub-only emotes, but the data's here.
	allowEmotesAnyChannel: true // Allow all BTTV emotes that are loaded no matter the channel restriction
};
var custom = {
	urlTmplate: 'https://enviosity.com/chat/emotes/{{id}}/{{image}}',
	scales: {1: '3', 2: '3', 3: '3'},
	bots: [],
	emoteList: ['enviBOOBA'],
	emotes: []
};
var emoteScale = 2;


var chat = document.getElementById('chat');
var defaultColors = ['rgb(255, 0, 0)','rgb(0, 0, 255)','rgb(0, 128, 0)','rgb(178, 34, 34)','rgb(255, 127, 80)','rgb(154, 205, 50)','rgb(255, 69, 0)','rgb(46, 139, 87)','rgb(218, 165, 32)','rgb(210, 105, 30)','rgb(95, 158, 160)','rgb(30, 144, 255)','rgb(255, 105, 180)','rgb(138, 43, 226)','rgb(0, 255, 127)'];
var randomColorsChosen = {};

function htmlEntities(html) { // Custom HTML entity encoder using an array
	function it(HTML) {
		return HTML.map(function(n, i, arr) { // Iterate
		if(n.length == 1) { // Avoid actual HTML
			return n.replace(/[\u00A0-\u9999<>\&]/gim, function(i) { // Replace all special characters (Brute force!)
				   return '&#' + i.charCodeAt(0) + ';'; // Replace with HTML entities
				});
		}
		return n;
		});
	}
	var isArray = Array.isArray(html); // Make sure it's an array
	if(!isArray) { // If not
		html = html.split(''); // Make it an array
	}
	html = it(html); // Do it!
	if(!isArray) html = html.join(''); // Join back if it wasn't an array
	return html; // Return the stuff
}

function get(uri, data, headers, method, cb, json) { // Simplification of jQuery Ajax for my use
	return $.ajax({
			url:		uri || '',			data:		data || {},
			headers:	headers || {},		type:		method || 'GET',
			dataType:	json !== true ? json : 'jsonp', // Prefer jsonp
			success:	cb || function() { console.log('success', arguments); },
			error:		cb || function() { console.log('error', uri, arguments); }
		});
}

// Find occurences of a string
function getIndicesOf(searchStr, str, caseSensitive) { // http://stackoverflow.com/a/3410557
	var startIndex = 0, searchStrLen = searchStr.length;
	var index, indices = [];
	if(!caseSensitive) {
		str = str.toLowerCase();
		searchStr = searchStr.toLowerCase();
	}
	while((index = str.indexOf(searchStr, startIndex)) > -1) {
		indices.push(index);
		startIndex = index + searchStrLen;
	}
	return indices;
}

// Merge array of objects
function do_merge(roles) { // http://stackoverflow.com/a/21196265
	var merger = function (a, b) {
		if (_.isObject(a)) {
			return _.extend({}, a, b, merger);
		}
		else {
			return a || b;
		}
	};
	var args = _.flatten([{}, roles, merger]);
	return _.extend.apply(_, args);
}

function formatEmotes(text, emotes, channel) { // Format the emotes into the text
	emotes = _.extend(emotes || {}, do_merge(bttvEmotes.emoteCodeList.map(function(n) { // Add BTTV emotes
		var indices = getIndicesOf(n, text, true),
		indMap = indices.map(function(m) {
			return [m, m + n.length - 1].join('-'); // Create indices for formatEmotes
		});
		var obj = {};
		obj[n] = indMap;
		return indMap.length === 0 ? null : obj;
	})));
	emotes = _.extend(emotes || {}, do_merge(frankerz.emoteCodeList.map(function(n) { // Add BTTV emotes
		var indices = getIndicesOf(n, text, true),
		indMap = indices.map(function(m) {
			return [m, m + n.length - 1].join('-'); // Create indices for formatEmotes
		});
		var obj = {};
		obj[n] = indMap;
		return indMap.length === 0 ? null : obj;
	})));
	emotes = _.extend(emotes || {}, )
    var splitText = text.split(''); // Separate into characters
    for(var i in emotes) { // Iterate through the emotes
        var e = emotes[i]; // An emote
        for(var j in e) { // Loop through this emote's instances
            var mote = e[j]; // Indices of this emote instance
            if(typeof mote == 'string') { // Make sure we're only getting the indices and not array methods, etc.
                mote = mote.split('-'); // Split indices 
                mote = [parseInt(mote[0]), parseInt(mote[1])]; // Parse to integers
                var length =  mote[1] - mote[0], // Get emote length
					emote = text.substr(mote[0], length + 1), // Get emote text
                    empty = Array.apply(null, new Array(length + 1)).map(function() { return ''; }); // Empty array to take up space of emote characters
				var permToReplace = true, // If it's a BTTV that is allowed to be used, this will still be true ... otherwise true for Twitch emotes
					options = { // Emote image options (Twitch emote by default)
							template: twitchEmotes.urlTemplate, // Use this URL template
							id: i, // Use this image ID
							image: twitchEmotes.scales[emoteScale] // Image scale
						};
				if(bttvEmotes.emoteCodeList.indexOf(emote) > -1) { // Set BTTV emote image options
					var bttvEmote = _.findWhere(bttvEmotes.emotes, { code: emote });
					options.template = bttvEmotes.urlTemplate;
					options.id = bttvEmote.id;
					options.image = bttvEmotes.scales[emoteScale];
				}else if(frankerz.emoteCodeList.indexOf(emote) > -1) { // Set Frankerz emote image options
					var franker = _.findWhere(frankerz.emotes, { code: emote });
					options.template = frankerz.urlTemplate;
					options.id = franker.id;
					options.image = frankerz.scales[emoteScale];					
				}
				var html = '<img class="emoticon" emote="' + emote + '" src="' + options.template
																							.replace('{{id}}', options.id)
																							.replace('{{image}}', options.image) + '">';
				splitText = splitText.slice(0, mote[0]).concat(empty).concat(splitText.slice(mote[1] + 1, splitText.length)); // Replace emote indices with empty space
				splitText.splice(mote[0], 1, html); // Insert emote HTML
            }
        }
    }
    return htmlEntities(splitText).join(''); // Encode non-images
}
function dehash(channel) {
	return channel.replace(/^#/, '');
}
function capitalize(n) {
	return n[0].toUpperCase() +  n.substr(1);
}
function play_sound(text, whom = "Brian"){
	var audio = new Audio("tts.php?text="+encodeURIComponent(text.trim()));
	audio.play();
}
function handleChat(channel, user, message, self) {
	console.log(message);
	play_sound(message);
	var chan = dehash(channel),
		name = user.username,
		chatLine = document.createElement('div'),
		chatChannel = document.createElement('span'),
		chatName = document.createElement('span'),
		chatColon = document.createElement('span'),
		chatMessage = document.createElement('span');
	
	var color = useColor ? user.color : 'inherit';
	if(color === null) {
		if(!randomColorsChosen.hasOwnProperty(chan)) {
			randomColorsChosen[chan] = {};
		}
		if(randomColorsChosen[chan].hasOwnProperty(name)) {
			color = randomColorsChosen[chan][name];
		}
		else {
			color = defaultColors[Math.floor(Math.random()*defaultColors.length)];
			randomColorsChosen[chan][name] = color;
		}
	}
	
	chatLine.className = 'chat-line';
	chatLine.dataset.username = name;
	chatLine.dataset.channel = channel;
	
	if(user['message-type'] == 'action') {
		chatLine.className += ' chat-action';
	}
	
	chatChannel.className = 'chat-channel';
	chatChannel.innerHTML = chan;
	
	chatName.className = 'chat-name';
	chatName.style.color = color;
	chatName.innerHTML = user['display-name'] || name;
	
	chatColon.className = 'chat-colon';
	
	chatMessage.className = 'chat-message';
	
	chatMessage.style.color = color;
	chatMessage.innerHTML = showEmotes ? formatEmotes(message, user.emotes, channel) : htmlEntities(message);
	
	//if(client.opts.channels.length > 1 && showChannel) chatLine.appendChild(chatChannel);
	if(showBadges) chatLine.appendChild(badges(chan, user, self));
	chatLine.appendChild(chatName);
	chatLine.appendChild(chatColon);
	chatLine.appendChild(chatMessage);
	
	chat.appendChild(chatLine);
	
	if(typeof fadeDelay == 'number') {
		setTimeout(function() {
				chatLine.dataset.faded = '';
			}, fadeDelay);
	}
	
	if(chat.children.length > 50) {
		var oldMessages = [].slice.call(chat.children).slice(0, 10);
		for(var i in oldMessages) oldMessages[i].remove();
	}
	var objDiv = document.getElementById("chat");
	objDiv.scrollTop = objDiv.scrollHeight;
}

function badges(chan, user, isBot) {
	
	function createBadge(name) {
		var badge = document.createElement('div');
		badge.className = 'chat-badge-' + name;
		return badge;
	}
	
	var chatBadges = document.createElement('span');
	chatBadges.className = 'chat-badges';
	
	if(!isBot) {
		if(user.username == chan) {
			chatBadges.appendChild(createBadge('broadcaster'));
		}
		if(user['user-type']) {
			chatBadges.appendChild(createBadge(user['user-type']));
		}
		if(user.turbo) {
			chatBadges.appendChild(createBadge('turbo'));
		}
	}
	else {
		chatChages.appendChild(createBadge('bot'));
	}
	
	return chatBadges;
}

function testMessage(channel, user, message, self) { // Throw away when done
	handleChat(channel || client.opts.channels[0], user || { 'display-name': 'TFBosoN', emotes: null }, message || '(chompy) bttvNice domeHey domeLit pepeJAMJAM', self || false);
}
function chatNotice(information, noticeFadeDelay, level, additionalClasses) {
	var ele = document.createElement('div');
	
	ele.className = 'chat-line chat-notice';
	ele.innerHTML = information;
	
	if(additionalClasses !== undefined) {
		if(Array.isArray(additionalClasses)) {
			additionalClasses = additionalClasses.join(' ');
		}
		ele.className += ' ' + additionalClasses;
	}
	
	if(typeof level == 'number' && level != 0) {
		ele.dataset.level = level;
	}
	
	chat.appendChild(ele);
	
	if(typeof noticeFadeDelay == 'number') {
		setTimeout(function() {
				ele.dataset.faded = '';
			}, noticeFadeDelay || 500);
	}
	
	return ele;
}

var recentTimeouts = {};
function timeout(channel, username) {
	if(!doTimeouts) return false;
	if(!recentTimeouts.hasOwnProperty(channel)) {
		recentTimeouts[channel] = {};
	}
	if(!recentTimeouts[channel].hasOwnProperty(username) || recentTimeouts[channel][username] + 1000*10 < +new Date) {
		recentTimeouts[channel][username] = +new Date;
		chatNotice(capitalize(username) + ' was timed-out in ' + capitalize(dehash(channel)), 1000, 1, 'chat-delete-timeout')
	};
	var toHide = document.querySelectorAll('.chat-line[data-channel="' + channel + '"][data-username="' + username + '"]:not(.chat-timedout) .chat-message');
	for(var i in toHide) {
		var h = toHide[i];
		if(typeof h == 'object') {
			h.innerText = '<Message deleted>';
			h.parentElement.className += ' chat-timedout';
		}
	}
}
function clearChat(channel) {
	if(!doChatClears) return false;
	var toHide = document.querySelectorAll('.chat-line[data-channel="' + channel + '"]');
	for(var i in toHide) {
		var h = toHide[i];
		if(typeof h == 'object') {
			h.className += ' chat-cleared';
		}
	}
	chatNotice('Chat was cleared in ' + capitalize(dehash(channel)), 1000, 1, 'chat-delete-clear')
}
function hosting(channel, target, viewers, unhost) {
	if(!showHosting) return false;
	if(viewers == '-') viewers = 0;
	var chan = dehash(channel);
	chan = capitalize(chan);
	if(!unhost) {
		var targ = capitalize(target);
		chatNotice(chan + ' is now hosting ' + targ + ' for ' + viewers + ' viewer' + (viewers !== 1 ? 's' : '') + '.', null, null, 'chat-hosting-yes');
	}
	else {
		chatNotice(chan + ' is no longer hosting.', null, null, 'chat-hosting-no');
	}
}
		
		
	console.log('%cThere\'s a function called \'testMessage\' that you can use to manually input messages', 'color:orange;');
	
	
	function mergeBTTVEmotes(data, channel) {
		console.log('Got BTTV emotes for ' + channel);
		bttvEmotes.emotes = bttvEmotes.emotes.concat(data.channelEmotes.map(function(n) {
				if(!_.has(n, 'restrictions')) {
					n.restrictions = {
							channels: [],
							games: []
						};
				}
				if(n.restrictions.channels.indexOf(channel) == -1) {
					n.restrictions.channels.push(channel);
				}
				return n;
			}));
		bttvEmotes.emotes = bttvEmotes.emotes.concat(data.sharedEmotes.map(function(n) {
				if(!_.has(n, 'restrictions')) {
					n.restrictions = {
							channels: [],
							games: []
						};
				}
				if(n.restrictions.channels.indexOf(channel) == -1) {
					n.restrictions.channels.push(channel);
				}
				return n;
			}));
	}
	function mergeBTTVEmotess(data, channel) {
		console.log('Got Frankerz emotes for ' + channel);
		frankerz.emotes = frankerz.emotes.concat(data.map(function(n) {
				if(!_.has(n, 'restrictions')) {
					n.restrictions = {
							channels: [],
							games: []
						};
				}
				if(n.restrictions.channels.indexOf(channel) == -1) {
					n.restrictions.channels.push(channel);
				}
				return n;
			}));
	}
	
	var asyncCalls = [get('https://api.betterttv.net/3/cached/emotes/global', {}, { Accept: 'application/json' }, 'GET', function(data) {
		console.log('Got BTTV global emotes');
		bttvEmotes.emotes = bttvEmotes.emotes.concat(data.map(function(n) {
				n.global = true;
				return n;
			}));
		bttvEmotes.subEmotesCodeList = _.chain(bttvEmotes.emotes).where({ global: true }).reject(function(n) { return _.isNull(n.channel); }).pluck('code').value();
	}, false)];
	var asyncCallss = [get('https://api.betterttv.net/3/cached/frankerfacez/users/twitch/44390855', {}, { Accept: 'application/json' }, 'GET', function(data) {
		console.log('Got Frankerz global emotes');
		frankerz.emotes = frankerz.emotes.concat(data.map(function(n) {
			return n;
		}));
		frankerz.subEmotesCodeList = _.chain(frankerz.emotes).where({ global: true }).reject(function(n) { return _.isNull(n.channel); }).pluck('code').value();
	}, false)];
	
	function addAsyncCall(channel) {
		asyncCalls.push(get('https://api.betterttv.net/3/cached/users/twitch/44390855', {}, { Accept: 'application/json' }, 'GET', function(data) {
			mergeBTTVEmotes(data, channel);
		}), false);
		data = {"channelEmotes": [
			{"id": "60ccf3bf8ed8b373e4215f11", "code":"BOOBA", "imgType":"png"},
		], "sharedEmotes":[]};
		mergeBTTVEmotes(data, channel); 
		asyncCallss.push(get('https://api.betterttv.net/3/cached/frankerfacez/users/twitch/44390855', {}, { Accept: 'application/json' }, 'GET', function(data) {
			mergeBTTVEmotess(data, channel);
		}), false);
	}
	client.connect();
	for(var i in channels) { // Add BTTV emotes for the channels we're connecting to.
		addAsyncCall(channels[i]);
	}
	
	$.when.apply({}, asyncCalls).always(function() {
		bttvEmotes.emoteCodeList = _.pluck(bttvEmotes.emotes, 'code');
	});
	$.when.apply({}, asyncCallss).always(function() {
		frankerz.emoteCodeList = _.pluck(frankerz.emotes, 'code');
	});
	client.addListener('message', handleChat);
	client.addListener('timeout', timeout);
	client.addListener('clearchat', clearChat);
	client.addListener('hosting', hosting);
	client.addListener('unhost', function(channel, viewers) { hosting(channel, null, viewers, true) });

	client.addListener('connecting', function (address, port) {
		if(showConnectionNotices) chatNotice('Connecting', 1000, -4, 'chat-connection-good-connecting');
	});
client.addListener('logon', function () {
		if(showConnectionNotices) chatNotice('Authenticating', 1000, -3, 'chat-connection-good-logon');
	});
client.addListener('connectfail', function () {
		if(showConnectionNotices) chatNotice('Connection failed', 1000, 3, 'chat-connection-bad-fail');
	});
client.addListener('connected', function (address, port) {
		if(showConnectionNotices) chatNotice('Connected', 1000, -2, 'chat-connection-good-connected');
		joinAccounced = [];
	});
client.addListener('disconnected', function (reason) {
		if(showConnectionNotices) chatNotice('Disconnected: ' + (reason || ''), 3000, 2, 'chat-connection-bad-disconnected');
	});
client.addListener('reconnect', function () {
		if(showConnectionNotices) chatNotice('Reconnected', 1000, 'chat-connection-good-reconnect');
	});
client.addListener('join', function (channel, username) {
		if(username == client.getUsername()) {
			if(showConnectionNotices) chatNotice('Joined ' + capitalize(dehash(channel)), 1000, -1, 'chat-room-join');
			joinAccounced.push(channel);
		}
	});
client.addListener('part', function (channel, username) {
		var index = joinAccounced.indexOf(channel);
		if(index > -1) {
			if(showConnectionNotices) chatNotice('Parted ' + capitalize(dehash(channel)), 1000, -1, 'chat-room-part');
			joinAccounced.splice(joinAccounced.indexOf(channel), 1)
		}
	});

client.addListener('crash', function () {
		chatNotice('Crashed', 10000, 4, 'chat-crash');
});
//testMessage();
testMessage('enviosity', null, "");


if (!$.cookie('twitch_auth')) {
	testMessage('enviosity', null, "Not authorized");
}else{
	testMessage('enviosity', null, "Authorized");
	client.say('tfboson', 'test');
}
