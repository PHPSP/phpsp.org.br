const copyTextToClipboard = require('./clipboard');

class ScrollSpy {
    constructor($content, $menu, $navbar) {
        if (!$content instanceof HTMLElement) {
            throw new Error('Content must be an HTML element');
        }
        if (!$menu instanceof HTMLElement) {
            throw new Error('Menu must be an HTML element');
        }
        if (!$navbar instanceof HTMLElement) {
            throw new Error('Navbar must be an HTML element');
        }

        const visitedNodes = {},
            headers = {},
            $links = $menu.querySelectorAll('a[href]'),
            $headers = Array.from($content.querySelectorAll('h1[id], h2[id], h3[id], h4[id], h5[id], h6[id]'));

        let oldActiveId,
            currentActiveId,
            navbarHeight,
            headerKeys = {};

        const getNode = (id) => {
            if (visitedNodes[id] === undefined) {
                visitedNodes[id] = $menu.querySelector(`a[href="#${id}"]`);
            }
            return visitedNodes[id];
        }

        const onScroll = function () {
            const SCROLL_TOP = (document.scrollingElement.scrollTop || document.body.scrollTop) + navbarHeight + 20; // some padding
            for (const id of headerKeys) {
                if (headers[id] < SCROLL_TOP) {
                    currentActiveId = id;
                    break;
                }
            }

            if ((currentActiveId) && (currentActiveId !== oldActiveId)) {
                let node = getNode(currentActiveId);
                if (!node) {
                    return;
                }
                history.replaceState(null, null, `#${currentActiveId}`);
                node.classList.add('active');
                if (oldActiveId) {
                    let node = getNode(oldActiveId);
                    if (node) {
                        node.classList.remove('active');
                    }
                }
                oldActiveId = currentActiveId;
            }
        };

        const calculateHeadersOffset = function () {
            navbarHeight = $navbar.getBoundingClientRect().y;
            $links.forEach(($link) => {
                const id = $link.attributes.href.value.substring(1);
                const $header = $headers.find(h => h.id === id);
                if ($header) {
                    headers[id] = $header.offsetTop;
                }
            });
            headerKeys = Object.keys(headers).reverse();
            onScroll();
        }

        $links.forEach(($link) => {
            const id = $link.attributes.href.value.substring(1);
            const $header = $headers.find(h => h.id === id);
            if ($header) {
                $link.addEventListener('click', function (e) {
                    e.preventDefault();
                    window.scrollTo({
                        top: $header.offsetTop - navbarHeight,
                    });
                });
            }
        });

        document.querySelectorAll('a.pilcrow[href]').forEach(
            (node) => node.addEventListener(
                'click',
                (e) => {
                    e.preventDefault();
                    copyTextToClipboard(node.href);
                }
            )
        );

        window.addEventListener('scrollend', onScroll);
        window.addEventListener('resize', calculateHeadersOffset);
        calculateHeadersOffset();
    }
}

module.exports = ScrollSpy;
