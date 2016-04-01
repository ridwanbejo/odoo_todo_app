# -*- coding: utf-8 -*-
{
    'name': "Todo App",
    'description': """
        Lorem ipsum sit dolor amet
    """,
    'author': "My Company",
    'website': "http://www.yourcompany.com",
    'category': 'Uncategorized',
    'version': '0.1',
    'depends': ['base', 'website'],
    'data': [
        'security/ir.model.access.csv',
        'views/views.xml',
        'views/templates.xml',
    ],
    'application': True,
    'installable':True,
    'active':True,
}