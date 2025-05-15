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

        // submission
        {
            path: "submission",
            component: () =>
                import(
                    /* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/submission/index.vue"
                ),
            children: [
                {
                    path: "",
                    name: "posyandu-submission",
                    component: () =>
                        import(
                            /* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/submission/crud/data.vue"
                        ),
                },

                {
                    path: "create",
                    name: "posyandu-submission-create",
                    component: () =>
                        import(
                            /* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/submission/crud/create.vue"
                        ),
                },

                {
                    path: ":submission/edit",
                    name: "posyandu-submission-edit",
                    component: () =>
                        import(
                            /* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/submission/crud/edit.vue"
                        ),
                },

                {
                    path: ":submission/show",
                    name: "posyandu-submission-show",
                    component: () =>
                        import(
                            /* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/submission/crud/show.vue"
                        ),
                },
            ],
        },

        // setting
        {
            path: "setting",
            component: () =>
                import(
                    /* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/setting/index.vue"
                ),
            children: [
                {
                    path: "",
                    name: "posyandu-setting",
                    component: () =>
                        import(
                            /* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/setting/crud/data.vue"
                        ),
                },

                {
                    path: "create",
                    name: "posyandu-setting-create",
                    component: () =>
                        import(
                            /* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/setting/crud/create.vue"
                        ),
                },

                {
                    path: ":setting/edit",
                    name: "posyandu-setting-edit",
                    component: () =>
                        import(
                            /* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/setting/crud/edit.vue"
                        ),
                },

                {
                    path: ":setting/show",
                    name: "posyandu-setting-show",
                    component: () =>
                        import(
                            /* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/setting/crud/show.vue"
                        ),
                },
            ],
        },

        // report
        {
            path: "report",
            name: "posyandu-report",
            component: () =>
                import(
                    /* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/report/index.vue"
                ),
        },

        // pagename
        // {
        // 	path: "pagename",
        // 	component: () =>
        // 		import(
        // 			/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/pagename/index.vue"
        // 		),
        // 	children: [
        // 		{
        // 			path: "",
        // 			name: "posyandu-pagename",
        // 			component: () =>
        // 				import(
        // 					/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/pagename/crud/data.vue"
        // 				),
        // 		},

        // 		{
        // 			path: "create",
        // 			name: "posyandu-pagename-create",
        // 			component: () =>
        // 				import(
        // 					/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/pagename/crud/create.vue"
        // 				),
        // 		},

        // 		{
        // 			path: ":pagename/edit",
        // 			name: "posyandu-pagename-edit",
        // 			component: () =>
        // 				import(
        // 					/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/pagename/crud/edit.vue"
        // 				),
        // 		},

        // 		{
        // 			path: ":pagename/show",
        // 			name: "posyandu-pagename-show",
        // 			component: () =>
        // 				import(
        // 					/* webpackChunkName: "posyandu" */ "@modules/posyandu/frontend/pages/pagename/crud/show.vue"
        // 				),
        // 		},
        // 	],
        // },
    ],
};
