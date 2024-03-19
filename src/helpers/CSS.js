/*
    Utilities to extract css properties from an element
    from https://css-tricks.com/how-to-get-all-custom-properties-on-a-page-in-javascript/
 */

const isSameDomain = (styleSheet) => {
    if (!styleSheet.href) {
        return true;
    }

    return styleSheet.href.indexOf(window.location.origin) === 0;
};

const isStyleRule = (rule) => rule.type === 1;

export const getCSSCustomPropIndex = (array) => array
    .filter(isSameDomain)
    .reduce((finalArr, sheet) => finalArr.concat(
        [...sheet.cssRules].filter(isStyleRule).reduce((propValArr, rule) => {
            const props = [...rule.style].map((propName) => [
                propName.trim(),
                rule.style.getPropertyValue(propName).trim()
            ]).filter(([propName]) => propName.indexOf("--") === 0 && propName.indexOf("-dark") === (propName.length - 5));
            return [...propValArr, ...props];
        }, [])
), []);


export const generateDarkModeStyleSheet = async () => {

    const darkModeStyles = getCSSCustomPropIndex([...document.styleSheets]);

    let css = '';
    darkModeStyles.forEach((prop) => {
        css += `${prop[0].replace('-dark', ':')}${prop[1]}; `;
    });

    const styleSheet = document.createElement('style');
    styleSheet.type = 'text/css';
    styleSheet.innerHTML = `html[data-scheme="dark"] body { ${css} }`;

    window.requestIdleCallback(() => {
        document.getElementsByTagName('head')[0].appendChild(styleSheet);
    });
}
