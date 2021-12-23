export default [
  {
    title: 'Dashboard',
    route: 'home',
    icon: 'HomeIcon',
	resource: '',
	action: '',
  },
  {
    title: 'Berita',
    icon: 'FileIcon',
	  children: [
		  {
			  title: 'List',
			  route: 'news-list',
			  resource: 'news',
			  action: 'list',
		  },
		  {
			  title: 'Tambah',
			  route: 'news-add',
			  resource: 'news',
			  action: 'create',
		  },
	  ],
  },
]
