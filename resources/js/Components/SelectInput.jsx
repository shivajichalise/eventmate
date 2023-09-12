import React, { forwardRef, useEffect, useRef } from "react";

export default forwardRef(function SelectInput(
    { options = [], className = "", isFocused = false, ...props },
    ref
) {
    const selectRef = ref ? ref : useRef();

    useEffect(() => {
        if (isFocused) {
            selectRef.current.focus();
        }
    }, [isFocused]);

    return (
        <select {...props} className={className} ref={selectRef}>
            {options.map((option) => (
                <option key={option.value} value={option.value}>
                    {option.label}
                </option>
            ))}
        </select>
    );
});
