<?php
/* ----------------------------------------------- *
 | [ XiaoLin ] Version : 2.0 beta
 | 简单粗暴又不失高雅的迫真 OOP MVC 框架，，，
 |
 | URL     : https://blog.test404.club/
 * ----------------------------------------------- *
 | Name    : 多语言:简体中文
 |
 | Author  : Xiaolin (a1475775412@foxmail.com)
 | LICENSE : WTFPL http://www.wtfpl.net/about
 * ----------------------------------------------- */

return [
	'无法自动加载类。'					=> '无法自动加载类。',
	'已加载类文件，但未成功加载类。'	=> '已加载类文件，但未成功加载类。',
	'连接数据库失败！'					=> '连接数据库失败！',
	'执行SQL查询语句时出现错误。'		=> '执行SQL查询语句时出现错误。',
	'arr2sql转换错误: 值应该是文本型/整数型/布尔型，却传入了数组或其他类型。'	=> 'arr2sql转换错误: 值应该是文本型/整数型/布尔型，却传入了数组或其他类型。',
	'arr2sql转换错误: 值应该是数组型，却传入了文本型/整数型/布尔型或其他类型。'	=> 'arr2sql转换错误: 值应该是数组型，却传入了文本型/整数型/布尔型或其他类型。',
	'路由规则内有未闭合括号！'			=> '路由规则内有未闭合括号！',
	'路由解析失败。'					=> '路由解析失败。',
	'未找到正则表达式。'				=> '未找到正则表达式。',
	'模板文件未找到！'					=> '模板文件未找到！',
	'应用目录不存在！'					=> '应用目录不存在！',
	'模板目录不存在！'					=> '模板目录不存在！',
	'配置文件目录不存在！'				=> '配置文件目录不存在！',
	'配置文件不存在！'					=> '配置文件不存在！',
	'配置文件未能通过类型验证！'		=> '配置文件未能通过类型验证！',

	'异常捕获 _(:з」∠)_'		=> '异常捕获 _(:з」∠)_',
	'页面地址：'				=> '页面地址：',
	'异常类型：'				=> '异常类型：',
	'异常代码：'				=> '异常代码：',
	'异常定位：'				=> '异常定位：',
	'的'						=> '的',
	'行'						=> '行',
	'异常信息：'				=> '异常信息：',
	'数据输出 (〜￣△￣)〜'		=> '数据输出 (〜￣△￣)〜',
	'来源追踪 ╮(╯﹏╰）╭'			=> '来源追踪 ╮(╯﹏╰）╭',
	'[全部打开]'				=> '[全部打开]',
	'[全部关闭]'				=> '[全部关闭]',
	'管理员信息'				=> '管理员信息',
	'请将错误信息发送给管理员'	=> '请将错误信息发送给管理员',
	
	'提示'						=> '提示',
	'%s 秒后返回上一页面...'	=> '%s 秒后返回上一页面...',
	'跳转'						=> '跳转',
	'返回上一页'				=> '返回上一页',
	
	'%s 秒后将为您自动跳转...'	=> '%s 秒后将为您自动跳转...',
	'[现在跳转]'				=> '[现在跳转]',
	'[雅蠛蝶！等等]'			=> '[雅蠛蝶！等等]',

	'xiaolin'	=> [
		'sysinfo'	=> [
			'antiCSRF'	=> [
				'code'	=> '403',
				'type'	=> 'error',
				'info'	=> '表单验证未通过!',
				'more'	=> [
					'您同时打开了多个页面',
					'您直接通过网址访问表单提交页面',
					'请尝试关掉其他页面',
					'或者返回首页再试一次'
				]
			],
			'statusCode'	=> [
				'404'		=> [
					'code'		=> '404',
					'type'		=> 'error', //[info, error, success]
					'title'		=> '啊哈... 出了一点点小问题_(:з」∠)_',
					'info'		=> '页面找不到啦...',
					'moreTitle'	=> '可能的原因：',
					'more'		=> [
						'手滑输错了地址',
						'该页面已移动到其他地址',
						'你在用脸滚键盘',
						'你的猫在键盘漫步'
					]
				],
				'403'		=> [
					'code'		=> '403',
					'type'		=> 'error', //[info, error, success]
					'title'		=> '拒绝访问 (╯‵□′)╯︵┻━┻',
					'info'		=> '该页面拒绝访问',
					'moreTitle'	=> '可能的原因：',
					'more'		=> [
						'你在尝试干点不好的事情',
						'程序员手滑写错了什么东西...',
						'你在用脸滚键盘',
						'你的猫在键盘漫步'
					]
				],
				'500'		=> [
					'code'		=> '500',
					'type'		=> 'error', //[info, error, success]
					'title'		=> '系统故障',
					'info'		=> '系统故障',
					'moreTitle'	=> '啊哈... 出了一点点小问题_(:з」∠)_',
					'more'		=> [
						'程序猿/媛写错了什么东西。',
						'发生了一些不可预料的事情。',
						'如果你发现了有什么不对，请迅速联系站点管理员',
						'如果没什么不对的，那就再试一次看看？'
					]
				]
			]
		],
		'errorManager'	=> [
			'adminInfo'	=> [
				'xiaolin框架'		=> '<a href="https://blog.test404.club/" target="_blank">https://blog.test404.club/</a>',
				'xiaolin框架作者'	=> 'Xiaolin (a1475775412@foxmail.com)',
			]
		]
	]
];