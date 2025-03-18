// import { Node, mergeAttributes } from "@tiptap/core";
//
// export const ResizableImage = Node.create({
//     name: "resizableImage",
//
//     addOptions() {
//         return {
//             HTMLAttributes: {},
//         };
//     },
//
//     group: "block",
//     inline: false,
//     selectable: true,
//
//     addAttributes() {
//         return {
//             src: {
//                 default: null,
//             },
//             width: {
//                 default: "300px",
//             },
//             height: {
//                 default: "auto",
//             },
//         };
//     },
//
//     parseHTML() {
//         return [
//             {
//                 tag: "img",
//                 getAttrs: (element) => ({
//                     src: element.getAttribute("src"),
//                     width: element.getAttribute("width") || "300px",
//                     height: element.getAttribute("height") || "auto",
//                 }),
//             },
//         ];
//     },
//
//     renderHTML({ HTMLAttributes }) {
//         return [
//             "div",
//             {
//                 class: "resizable-image-wrapper",
//                 style: `display: inline-block; position: relative;`,
//             },
//             [
//                 "img",
//                 mergeAttributes(this.options.HTMLAttributes, HTMLAttributes),
//             ],
//             [
//                 "div",
//                 {
//                     class: "resize-handle",
//                     contenteditable: "false",
//                 },
//             ],
//         ];
//     },
//
//     addNodeView() {
//         return ({ node, editor, getPos }) => {
//             const container = document.createElement("div");
//             container.classList.add("resizable-image-wrapper");
//             container.style.position = "relative";
//             container.style.display = "inline-block";
//
//             const img = document.createElement("img");
//             img.src = node.attrs.src;
//             img.style.width = node.attrs.width;
//             img.style.height = node.attrs.height;
//             img.style.display = "block";
//
//             const handle = document.createElement("div");
//             handle.classList.add("resize-handle");
//             handle.style.position = "absolute";
//             handle.style.bottom = "0";
//             handle.style.right = "0";
//             handle.style.width = "16px";
//             handle.style.height = "16px";
//             handle.style.background = "rgba(0,0,0,0.5)";
//             handle.style.cursor = "nwse-resize";
//
//             let isResizing = false;
//
//             handle.addEventListener("mousedown", (event) => {
//                 event.preventDefault();
//                 isResizing = true;
//
//                 const startX = event.clientX;
//                 const startWidth = img.offsetWidth;
//
//                 const onMouseMove = (moveEvent) => {
//                     if (!isResizing) return;
//
//                     const newWidth = startWidth + (moveEvent.clientX - startX);
//                     img.style.width = `${newWidth}px`;
//
//                     editor.commands.updateAttributes("resizableImage", {
//                         width: `${newWidth}px`,
//                     });
//                 };
//
//                 const onMouseUp = () => {
//                     isResizing = false;
//                     document.removeEventListener("mousemove", onMouseMove);
//                     document.removeEventListener("mouseup", onMouseUp);
//                 };
//
//                 document.addEventListener("mousemove", onMouseMove);
//                 document.addEventListener("mouseup", onMouseUp);
//             });
//
//             container.appendChild(img);
//             container.appendChild(handle);
//
//             return {
//                 dom: container,
//                 contentDOM: img,
//             };
//         };
//     },
// });


import { Node, mergeAttributes } from "@tiptap/core";

export const ResizableImage = Node.create({
    name: "resizableImage", // 👈 Должно совпадать с тем, что используем в `setNode()`

    group: "block",
    inline: false,
    selectable: true,

    addAttributes() {
        return {
            src: { default: null },
            width: { default: "300px" },
            height: { default: "auto" },
        };
    },

    parseHTML() {
        return [
            {
                tag: "img",
                getAttrs: (element) => ({
                    src: element.getAttribute("src"),
                    width: element.getAttribute("width") || "300px",
                    height: element.getAttribute("height") || "auto",
                }),
            },
        ];
    },

    renderHTML({ HTMLAttributes }) {
        return ["img", mergeAttributes(HTMLAttributes)];
    },

    addNodeView() {
        return ({ node, editor, getPos }) => {
            const container = document.createElement("div");
            container.style.display = "inline-block";
            container.style.position = "relative";

            const img = document.createElement("img");
            img.src = node.attrs.src;
            img.style.width = node.attrs.width;
            img.style.height = node.attrs.height;
            img.style.display = "block";

            container.appendChild(img);
            return { dom: container };
        };
    },
});