import { Link, router } from '@inertiajs/react';
import { BookOpen, FolderGit2, LayoutGrid, CalendarDays, Calendar, LogOut, MapPin, Users } from 'lucide-react';
import AppLogo from '@/components/app-logo';
import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarTrigger,
} from '@/components/ui/sidebar';
import { dashboard, cuti, kalender, logout } from '@/routes';
import type { NavItem } from '@/types';
import { useMobileNavigation } from '@/hooks/use-mobile-navigation';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Cuti',
        href: cuti(),
        icon: CalendarDays,
    },
    {
        title: 'Kalender',
        href: kalender(),
        icon: Calendar,
    },
    {
        title: 'Dinas Luar',
        href: '/dinas-luar',
        icon: MapPin,
    },
    {
        title: 'Data Pegawai',
        href: '/pegawai',
        icon: Users,
    },
];

export function AppSidebar() {
    const cleanup = useMobileNavigation();

    const handleLogout = () => {
        cleanup();
        router.flushAll();
    };

    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href={dashboard()} prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton asChild>
                            <Link
                                href={logout()}
                                as="button"
                                method="post"
                                onClick={handleLogout}
                            >
                                <LogOut className="h-8 w-8" />
                                <span>Log out</span>
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
