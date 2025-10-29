export default {
	path: "/posyandu",
	meta: { requiredAuth: true },
	component: () =>
		import(
			/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/Base.vue"
		),
	children: [
		{
			path: "",
			redirect: { name: "posyandu-dashboard" },
		},

		{
			path: "dashboard",
			name: "posyandu-dashboard",
			component: () =>
				import(
					/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/dashboard/index.vue"
				),
		},

		// activity
		{
			path: "activity",
			component: () =>
				import(
					/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/activity/index.vue"
				),
			children: [
				{
					path: "",
					name: "posyandu-activity",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/activity/crud/data.vue"
						),
				},

				// {
				// 	path: "create",
				// 	name: "posyandu-activity-create",
				// 	component: () =>
				// 		import(
				// 			/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/activity/crud/create.vue"
				// 		),
				// },

				// {
				// 	path: ":activity/edit",
				// 	name: "posyandu-activity-edit",
				// 	component: () =>
				// 		import(
				// 			/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/activity/crud/edit.vue"
				// 		),
				// },

				{
					path: ":activity/show",
					name: "posyandu-activity-show",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/activity/crud/show.vue"
						),
				},
			],
		},

		// beneficiary
		{
			path: "beneficiary",
			component: () =>
				import(
					/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/beneficiary/index.vue"
				),
			children: [
				{
					path: "",
					name: "posyandu-beneficiary",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/beneficiary/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "posyandu-beneficiary-create",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/beneficiary/crud/create.vue"
						),
				},

				{
					path: ":beneficiary/edit",
					name: "posyandu-beneficiary-edit",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/beneficiary/crud/edit.vue"
						),
				},

				{
					path: ":beneficiary/show",
					name: "posyandu-beneficiary-show",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/beneficiary/crud/show.vue"
						),
				},
			],
		},

		// category
		{
			path: "category",
			component: () =>
				import(
					/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/category/index.vue"
				),
			children: [
				{
					path: "",
					name: "posyandu-category",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/category/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "posyandu-category-create",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/category/crud/create.vue"
						),
				},

				{
					path: ":category/edit",
					name: "posyandu-category-edit",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/category/crud/edit.vue"
						),
				},

				{
					path: ":category/show",
					name: "posyandu-category-show",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/category/crud/show.vue"
						),
				},
			],
		},

		// complaint
		{
			path: "complaint",
			component: () =>
				import(
					/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/complaint/index.vue"
				),
			children: [
				{
					path: "",
					name: "posyandu-complaint",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/complaint/crud/data.vue"
						),
				},

				// {
				// 	path: "create",
				// 	name: "posyandu-complaint-create",
				// 	component: () =>
				// 		import(
				// 			/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/complaint/crud/create.vue"
				// 		),
				// },

				// {
				// 	path: ":complaint/edit",
				// 	name: "posyandu-complaint-edit",
				// 	component: () =>
				// 		import(
				// 			/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/complaint/crud/edit.vue"
				// 		),
				// },

				{
					path: ":complaint/show",
					name: "posyandu-complaint-show",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/complaint/crud/show.vue"
						),
				},
			],
		},

		// document
		{
			path: "document",
			component: () =>
				import(
					/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/document/index.vue"
				),
			children: [
				{
					path: "",
					name: "posyandu-document",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/document/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "posyandu-document-create",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/document/crud/create.vue"
						),
				},

				{
					path: ":document/edit",
					name: "posyandu-document-edit",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/document/crud/edit.vue"
						),
				},

				{
					path: ":document/show",
					name: "posyandu-document-show",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/document/crud/show.vue"
						),
				},
			],
		},

		// report
		{
			path: "report",
			component: () =>
				import(
					/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/report/index.vue"
				),
			children: [
				{
					path: "",
					name: "posyandu-report",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/report/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "posyandu-report-create",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/report/crud/create.vue"
						),
				},

				{
					path: ":report/edit",
					name: "posyandu-report-edit",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/report/crud/edit.vue"
						),
				},

				{
					path: ":report/show",
					name: "posyandu-report-show",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/report/crud/show.vue"
						),
				},
			],
		},

		// service
		{
			path: "service",
			component: () =>
				import(
					/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/service/index.vue"
				),
			children: [
				{
					path: "",
					name: "posyandu-service",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/service/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "posyandu-service-create",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/service/crud/create.vue"
						),
				},

				{
					path: ":service/edit",
					name: "posyandu-service-edit",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/service/crud/edit.vue"
						),
				},

				{
					path: ":service/show",
					name: "posyandu-service-show",
					component: () =>
						import(
							/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/service/crud/show.vue"
						),
				},
			],
		},
	],
};
