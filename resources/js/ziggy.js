const Ziggy = {
    url: 'https:\/\/docuvault.test',
    port: null,
    defaults: {},
    routes: {
        'boost.browser-logs': { uri: '_boost\/browser-logs', methods: ['POST'] },
        dashboard: { uri: '\/', methods: ['GET', 'HEAD'] },
        checked: { uri: 'checked', methods: ['POST'] },
        'storage.local': { uri: 'storage\/{path}', methods: ['GET', 'HEAD'], wheres: { path: '.*' }, parameters: ['path'] },
    },
};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export default { Ziggy };
