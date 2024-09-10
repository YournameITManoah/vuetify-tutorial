interface Nav {
    items: NavItem[]
}

interface NavItem {
    title: string
    icon: string
    to: string
    exact?: boolean
}

export default {
    items: [
        {
            title: 'Dashboard',
            icon: 'mdi-view-dashboard',
            to: '/dashboard',
        },
        {
            title: 'People',
            icon: 'mdi-account-group',
            to: '/people',
        },
    ],
} satisfies Nav
