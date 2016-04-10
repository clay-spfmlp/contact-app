var Vue = require('vue');
window.$ = window.jQuery = require('jquery');
var bootstrap = require('bootstrap/dist/js/bootstrap');
var VueResource = require('vue-resource');

Vue.use(VueResource);

new Vue({

	name: 'Landing',

	el: '#landing',

	data: {
		name: [
			{letter: 'C', show: false, highlight: false},
			{letter: 'l', show: false, highlight: false},
			{letter: 'a', show: false, highlight: false},
			{letter: 'y', show: false, highlight: false},
			{letter: '.', show: false, highlight: false},
			{letter: 'M', show: false, highlight: false},
			{letter: 'a', show: false, highlight: false},
			{letter: 'l', show: false, highlight: false},
			{letter: 'v', show: false, highlight: false},
			{letter: 'e', show: false, highlight: false},
			{letter: 'n', show: false, highlight: false},
			{letter: '&nbsp;', show: false, highlight: false},
			{letter: '=', show: false, highlight: false},
			{letter: '&nbsp;', show: false, highlight: false},
			{letter: '\"', show: false, highlight: false},
			{letter: 'W', show: false, highlight: false},
			{letter: 'e', show: false, highlight: false},
			{letter: 'b', show: false, highlight: false},
			{letter: '&nbsp;', show: false, highlight: false},
			{letter: 'D', show: false, highlight: false},
			{letter: 'e', show: false, highlight: false},
			{letter: 'v', show: false, highlight: false},
			{letter: 'e', show: false, highlight: false},
			{letter: 'l', show: false, highlight: false},
			{letter: 'o', show: false, highlight: false},
			{letter: 'p', show: false, highlight: false},
			{letter: 'e', show: false, highlight: false},
			{letter: 'r', show: false, highlight: false},
			{letter: '\"', show: false, highlight: false},
			{letter: '\;', show: false, highlight: false},
		]

	},

  	created: function () {
  		setTimeout(function(){ this.setName(200); }.bind(this), 3000);
  		setTimeout(function(){ this.highlight(16); }.bind(this), 10000);
  		setTimeout(function(){ this.setMessage(); }.bind(this), 11500);
  		setTimeout(function(){ this.highlight(16);}.bind(this), 17000);
  		setTimeout(function(){ this.setMessage2();}.bind(this), 18500);
  	},

	methods: {
		setName: function (time) {
			for (var i = 0; i <= this.name.length - 1; i++) {
				setTimeout(function(x) {
					return function() { this.name[x].show = true; }; 
				}(i).bind(this), time*i);
			}
		},

		setMessage: function () {
			this.name = [
				{letter: 'Clay', show: true, highlight: false},
				{letter: '.', show: true, highlight: false},
				{letter: 'Malven', show: true, highlight: false},
				{letter: '&nbsp;', show: true, highlight: false},
				{letter: '=', show: true, highlight: false},
				{letter: '&nbsp;', show: true, highlight: false},						
				{letter: '\"', show: false, highlight: false},
				{letter: 'P', show: false, highlight: false},
				{letter: 'H', show: false, highlight: false},
				{letter: 'P', show: false, highlight: false},
				{letter: '&nbsp;', show: false, highlight: false},
				{letter: 'D', show: false, highlight: false},
				{letter: 'e', show: false, highlight: false},
				{letter: 'v', show: false, highlight: false},
				{letter: 'e', show: false, highlight: false},
				{letter: 'l', show: false, highlight: false},
				{letter: 'o', show: false, highlight: false},
				{letter: 'p', show: false, highlight: false},
				{letter: 'e', show: false, highlight: false},
				{letter: 'r', show: false, highlight: false},
				{letter: '\"', show: false, highlight: false},
				{letter: '\;', show: false, highlight: false},
			];

			this.setName(200);
		},

		setMessage2: function () {
			this.name = [
				{letter: 'Clay', show: true, highlight: false},
				{letter: '.', show: true, highlight: false},
				{letter: 'Malven', show: true, highlight: false},
				{letter: '&nbsp;', show: true, highlight: false},
				{letter: '=', show: true, highlight: false},
				{letter: '&nbsp;', show: true, highlight: false},
				{letter: '\*', show: false, highlight: false},
				{letter: '&nbsp;.&nbsp;', show: false, highlight: false},
				{letter: '\"&nbsp;', show: false, highlight: false},
				{letter: 'D', show: false, highlight: false},
				{letter: 'e', show: false, highlight: false},
				{letter: 'v', show: false, highlight: false},
				{letter: 'e', show: false, highlight: false},
				{letter: 'l', show: false, highlight: false},
				{letter: 'o', show: false, highlight: false},
				{letter: 'p', show: false, highlight: false},
				{letter: 'e', show: false, highlight: false},
				{letter: 'r', show: false, highlight: false},
				{letter: '\"', show: false, highlight: false},
				{letter: '\;', show: false, highlight: false},
			];

			this.setName(200);		
		},

		highlight: function (n) {
			var r = this.name.length - n;
			for (var i = this.name.length - 1; i >= r; i--) {
				this.name[i].highlight = true;
			}
		}
	}

});