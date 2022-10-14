/*!
 * FilePondPluginImagePreview 4.6.10
 * Licensed under MIT, https://opensource.org/licenses/MIT/
 * Please visit https://pqina.nl/filepond/ for details.
 */

/* eslint-disable */

(function(global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined'
    ? (module.exports = factory())
    : typeof define === 'function' && define.amd
    ? define(factory)
    : ((global = global || self),
      (global.FilePondPluginImagePreview = factory()));
})(this, function() {
  'use strict';

  // test if file is of type image and can be viewed in canvas
  var isPreviewableImage = function isPreviewableImage(file) {
    return /^image/.test(file.type);
  };

  function _typeof(obj) {
    if (typeof Symbol === 'function' && typeof Symbol.iterator === 'symbol') {
      _typeof = function(obj) {
        return typeof obj;
      };
    } else {
      _typeof = function(obj) {
        return obj &&
          typeof Symbol === 'function' &&
          obj.constructor === Symbol &&
          obj !== Symbol.prototype
          ? 'symbol'
          : typeof obj;
      };
    }

    return _typeof(obj);
  }

  var REACT_ELEMENT_TYPE;

  function _jsx(type, props, key, children) {
    if (!REACT_ELEMENT_TYPE) {
      REACT_ELEMENT_TYPE =
        (typeof Symbol === 'function' &&
          Symbol.for &&
          Symbol.for('react.element')) ||
        0xeac7;
    }

    var defaultProps = type && type.defaultProps;
    var childrenLength = arguments.length - 3;

    if (!props && childrenLength !== 0) {
      props = {
        children: void 0
      };
    }

    if (props && defaultProps) {
      for (var propName in defaultProps) {
        if (props[propName] === void 0) {
          props[propName] = defaultProps[propName];
        }
      }
    } else if (!props) {
      props = defaultProps || {};
    }

    if (childrenLength === 1) {
      props.children = children;
    } else if (childrenLength > 1) {
      var childArray = new Array(childrenLength);

      for (var i = 0; i < childrenLength; i++) {
        childArray[i] = arguments[i + 3];
      }

      props.children = childArray;
    }

    return {
      $$typeof: REACT_ELEMENT_TYPE,
      type: type,
      key: key === undefined ? null : '' + key,
      ref: null,
      props: props,
      _owner: null
    };
  }

  function _asyncIterator(iterable) {
    var method;

    if (typeof Symbol === 'function') {
      if (Symbol.asyncIterator) {
        method = iterable[Symbol.asyncIterator];
        if (method != null) return method.call(iterable);
      }

      if (Symbol.iterator) {
        method = iterable[Symbol.iterator];
        if (method != null) return method.call(iterable);
      }
    }

    throw new TypeError('Object is not async iterable');
  }

  function _AwaitValue(value) {
    this.wrapped = value;
  }

  function _AsyncGenerator(gen) {
    var front, back;

    function send(key, arg) {
      return new Promise(function(resolve, reject) {
        var request = {
          key: key,
          arg: arg,
          resolve: resolve,
          reject: reject,
          next: null
        };

        if (back) {
          back = back.next = request;
        } else {
          front = back = request;
          resume(key, arg);
        }
      });
    }

    function resume(key, arg) {
      try {
        var result = gen[key](arg);
        var value = result.value;
        var wrappedAwait = value instanceof _AwaitValue;
        Promise.resolve(wrappedAwait ? value.wrapped : value).then(
          function(arg) {
            if (wrappedAwait) {
              resume('next', arg);
              return;
            }

            settle(result.done ? 'return' : 'normal', arg);
          },
          function(err) {
            resume('throw', err);
          }
        );
      } catch (err) {
        settle('throw', err);
      }
    }

    function settle(type, value) {
      switch (type) {
        case 'return':
          front.resolve({
            value: value,
            done: true
          });
          break;

        case 'throw':
          front.reject(value);
          break;

        default:
          front.resolve({
            value: value,
            done: false
          });
          break;
      }

      front = front.next;

      if (front) {
        resume(front.key, front.arg);
      } else {
        back = null;
      }
    }

    this._invoke = send;

    if (typeof gen.return !== 'function') {
      this.return = undefined;
    }
  }

  if (typeof Symbol === 'function' && Symbol.asyncIterator) {
    _AsyncGenerator.prototype[Symbol.asyncIterator] = function() {
      return this;
    };
  }

  _AsyncGenerator.prototype.next = function(arg) {
    return this._invoke('next', arg);
  };

  _AsyncGenerator.prototype.throw = function(arg) {
    return this._invoke('throw', arg);
  };

  _AsyncGenerator.prototype.return = function(arg) {
    return this._invoke('return', arg);
  };

  function _wrapAsyncGenerator(fn) {
    return function() {
      return new _AsyncGenerator(fn.apply(this, arguments));
    };
  }

  function _awaitAsyncGenerator(value) {
    return new _AwaitValue(value);
  }

  function _asyncGeneratorDelegate(inner, awaitWrap) {
    var iter = {},
      waiting = false;

    function pump(key, value) {
      waiting = true;
      value = new Promise(function(resolve) {
        resolve(inner[key](value));
      });
      return {
        done: false,
        value: awaitWrap(value)
      };
    }

    if (typeof Symbol === 'function' && Symbol.iterator) {
      iter[Symbol.iterator] = function() {
        return this;
      };
    }

    iter.next = function(value) {
      if (waiting) {
        waiting = false;
        return value;
      }

      return pump('next', value);
    };

    if (typeof inner.throw === 'function') {
      iter.throw = function(value) {
        if (waiting) {
          waiting = false;
          throw value;
        }

        return pump('throw', value);
      };
    }

    if (typeof inner.return === 'function') {
      iter.return = function(value) {
        return pump('return', value);
      };
    }

    return iter;
  }

  function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {
    try {
      var info = gen[key](arg);
      var value = info.value;
    } catch (error) {
      reject(error);
      return;
    }

    if (info.done) {
      resolve(value);
    } else {
      Promise.resolve(value).then(_next, _throw);
    }
  }

  function _asyncToGenerator(fn) {
    return function() {
      var self = this,
        args = arguments;
      return new Promise(function(resolve, reject) {
        var gen = fn.apply(self, args);

        function _next(value) {
          asyncGeneratorStep(
            gen,
            resolve,
            reject,
            _next,
            _throw,
            'next',
            value
          );
        }

        function _throw(err) {
          asyncGeneratorStep(gen, resolve, reject, _next, _throw, 'throw', err);
        }

        _next(undefined);
      });
    };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError('Cannot call a class as a function');
    }
  }

  function _defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];
      descriptor.enumerable = descriptor.enumerable || false;
      descriptor.configurable = true;
      if ('value' in descriptor) descriptor.writable = true;
      Object.defineProperty(target, descriptor.key, descriptor);
    }
  }

  function _createClass(Constructor, protoProps, staticProps) {
    if (protoProps) _defineProperties(Constructor.prototype, protoProps);
    if (staticProps) _defineProperties(Constructor, staticProps);
    return Constructor;
  }

  function _defineEnumerableProperties(obj, descs) {
    for (var key in descs) {
      var desc = descs[key];
      desc.configurable = desc.enumerable = true;
      if ('value' in desc) desc.writable = true;
      Object.defineProperty(obj, key, desc);
    }

    if (Object.getOwnPropertySymbols) {
      var objectSymbols = Object.getOwnPropertySymbols(descs);

      for (var i = 0; i < objectSymbols.length; i++) {
        var sym = objectSymbols[i];
        var desc = descs[sym];
        desc.configurable = desc.enumerable = true;
        if ('value' in desc) desc.writable = true;
        Object.defineProperty(obj, sym, desc);
      }
    }

    return obj;
  }

  function _defaults(obj, defaults) {
    var keys = Object.getOwnPropertyNames(defaults);

    for (var i = 0; i < keys.length; i++) {
      var key = keys[i];
      var value = Object.getOwnPropertyDescriptor(defaults, key);

      if (value && value.configurable && obj[key] === undefined) {
        Object.defineProperty(obj, key, value);
      }
    }

    return obj;
  }

  function _defineProperty(obj, key, value) {
    if (key in obj) {
      Object.defineProperty(obj, key, {
        value: value,
        enumerable: true,
        configurable: true,
        writable: true
      });
    } else {
      obj[key] = value;
    }

    return obj;
  }

  function _extends() {
    _extends =
      Object.assign ||
      function(target) {
        for (var i = 1; i < arguments.length; i++) {
          var source = arguments[i];

          for (var key in source) {
            if (Object.prototype.hasOwnProperty.call(source, key)) {
              target[key] = source[key];
            }
          }
        }

        return target;
      };

    return _extends.apply(this, arguments);
  }

  function _objectSpread(target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i] != null ? arguments[i] : {};
      var ownKeys = Object.keys(source);

      if (typeof Object.getOwnPropertySymbols === 'function') {
        ownKeys = ownKeys.concat(
          Object.getOwnPropertySymbols(source).filter(function(sym) {
            return Object.getOwnPropertyDescriptor(source, sym).enumerable;
          })
        );
      }

      ownKeys.forEach(function(key) {
        _defineProperty(target, key, source[key]);
      });
    }

    return target;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== 'function' && superClass !== null) {
      throw new TypeError('Super expression must either be null or a function');
    }

    subClass.prototype = Object.create(superClass && superClass.prototype, {
      constructor: {
        value: subClass,
        writable: true,
        configurable: true
      }
    });
    if (superClass) _setPrototypeOf(subClass, superClass);
  }

  function _inheritsLoose(subClass, superClass) {
    subClass.prototype = Object.create(superClass.prototype);
    subClass.prototype.constructor = subClass;
    subClass.__proto__ = superClass;
  }

  function _getPrototypeOf(o) {
    _getPrototypeOf = Object.setPrototypeOf
      ? Object.getPrototypeOf
      : function _getPrototypeOf(o) {
          return o.__proto__ || Object.getPrototypeOf(o);
        };
    return _getPrototypeOf(o);
  }

  function _setPrototypeOf(o, p) {
    _setPrototypeOf =
      Object.setPrototypeOf ||
      function _setPrototypeOf(o, p) {
        o.__proto__ = p;
        return o;
      };

    return _setPrototypeOf(o, p);
  }

  function isNativeReflectConstruct() {
    if (typeof Reflect === 'undefined' || !Reflect.construct) return false;
    if (Reflect.construct.sham) return false;
    if (typeof Proxy === 'function') return true;

    try {
      Date.prototype.toString.call(Reflect.construct(Date, [], function() {}));
      return true;
    } catch (e) {
      return false;
    }
  }

  function _construct(Parent, args, Class) {
    if (isNativeReflectConstruct()) {
      _construct = Reflect.construct;
    } else {
      _construct = function _construct(Parent, args, Class) {
        var a = [null];
        a.push.apply(a, args);
        var Constructor = Function.bind.apply(Parent, a);
        var instance = new Constructor();
        if (Class) _setPrototypeOf(instance, Class.prototype);
        return instance;
      };
    }

    return _construct.apply(null, arguments);
  }

  function _isNativeFunction(fn) {
    return Function.toString.call(fn).indexOf('[native code]') !== -1;
  }

  function _wrapNativeSuper(Class) {
    var _cache = typeof Map === 'function' ? new Map() : undefined;

    _wrapNativeSuper = function _wrapNativeSuper(Class) {
      if (Class === null || !_isNativeFunction(Class)) return Class;

      if (typeof Class !== 'function') {
        throw new TypeError(
          'Super expression must either be null or a function'
        );
      }

      if (typeof _cache !== 'undefined') {
        if (_cache.has(Class)) return _cache.get(Class);

        _cache.set(Class, Wrapper);
      }

      function Wrapper() {
        return _construct(Class, arguments, _getPrototypeOf(this).constructor);
      }

      Wrapper.prototype = Object.create(Class.prototype, {
        constructor: {
          value: Wrapper,
          enumerable: false,
          writable: true,
          configurable: true
        }
      });
      return _setPrototypeOf(Wrapper, Class);
    };

    return _wrapNativeSuper(Class);
  }

  function _instanceof(left, right) {
    if (
      right != null &&
      typeof Symbol !== 'undefined' &&
      right[Symbol.hasInstance]
    ) {
      return right[Symbol.hasInstance](left);
    } else {
      return left instanceof right;
    }
  }

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule
      ? obj
      : {
          default: obj
        };
  }

  function _interopRequireWildcard(obj) {
    if (obj && obj.__esModule) {
      return obj;
    } else {
      var newObj = {};

      if (obj != null) {
        for (var key in obj) {
          if (Object.prototype.hasOwnProperty.call(obj, key)) {
            var desc =
              Object.defineProperty && Object.getOwnPropertyDescriptor
                ? Object.getOwnPropertyDescriptor(obj, key)
                : {};

            if (desc.get || desc.set) {
              Object.defineProperty(newObj, key, desc);
            } else {
              newObj[key] = obj[key];
            }
          }
        }
      }

      newObj.default = obj;
      return newObj;
    }
  }

  function _newArrowCheck(innerThis, boundThis) {
    if (innerThis !== boundThis) {
      throw new TypeError('Cannot instantiate an arrow function');
    }
  }

  function _objectDestructuringEmpty(obj) {
    if (obj == null) throw new TypeError('Cannot destructure undefined');
  }

  function _objectWithoutPropertiesLoose(source, excluded) {
    if (source == null) return {};
    var target = {};
    var sourceKeys = Object.keys(source);
    var key, i;

    for (i = 0; i < sourceKeys.length; i++) {
      key = sourceKeys[i];
      if (excluded.indexOf(key) >= 0) continue;
      target[key] = source[key];
    }

    return target;
  }

  function _objectWithoutProperties(source, excluded) {
    if (source == null) return {};

    var target = _objectWithoutPropertiesLoose(source, excluded);

    var key, i;

    if (Object.getOwnPropertySymbols) {
      var sourceSymbolKeys = Object.getOwnPropertySymbols(source);

      for (i = 0; i < sourceSymbolKeys.length; i++) {
        key = sourceSymbolKeys[i];
        if (excluded.indexOf(key) >= 0) continue;
        if (!Object.prototype.propertyIsEnumerable.call(source, key)) continue;
        target[key] = source[key];
      }
    }

    return target;
  }

  function _assertThisInitialized(self) {
    if (self === void 0) {
      throw new ReferenceError(
        "this hasn't been initialised - super() hasn't been called"
      );
    }

    return self;
  }

  function _possibleConstructorReturn(self, call) {
    if (call && (typeof call === 'object' || typeof call === 'function')) {
      return call;
    }

    return _assertThisInitialized(self);
  }

  function _superPropBase(object, property) {
    while (!Object.prototype.hasOwnProperty.call(object, property)) {
      object = _getPrototypeOf(object);
      if (object === null) break;
    }

    return object;
  }

  function _get(target, property, receiver) {
    if (typeof Reflect !== 'undefined' && Reflect.get) {
      _get = Reflect.get;
    } else {
      _get = function _get(target, property, receiver) {
        var base = _superPropBase(target, property);

        if (!base) return;
        var desc = Object.getOwnPropertyDescriptor(base, property);

        if (desc.get) {
          return desc.get.call(receiver);
        }

        return desc.value;
      };
    }

    return _get(target, property, receiver || target);
  }

  function set(target, property, value, receiver) {
    if (typeof Reflect !== 'undefined' && Reflect.set) {
      set = Reflect.set;
    } else {
      set = function set(target, property, value, receiver) {
        var base = _superPropBase(target, property);

        var desc;

        if (base) {
          desc = Object.getOwnPropertyDescriptor(base, property);

          if (desc.set) {
            desc.set.call(receiver, value);
            return true;
          } else if (!desc.writable) {
            return false;
          }
        }

        desc = Object.getOwnPropertyDescriptor(receiver, property);

        if (desc) {
          if (!desc.writable) {
            return false;
          }

          desc.value = value;
          Object.defineProperty(receiver, property, desc);
        } else {
          _defineProperty(receiver, property, value);
        }

        return true;
      };
    }

    return set(target, property, value, receiver);
  }

  function _set(target, property, value, receiver, isStrict) {
    var s = set(target, property, value, receiver || target);

    if (!s && isStrict) {
      throw new Error('failed to set property');
    }

    return value;
  }

  function _taggedTemplateLiteral(strings, raw) {
    if (!raw) {
      raw = strings.slice(0);
    }

    return Object.freeze(
      Object.defineProperties(strings, {
        raw: {
          value: Object.freeze(raw)
        }
      })
    );
  }

  function _taggedTemplateLiteralLoose(strings, raw) {
    if (!raw) {
      raw = strings.slice(0);
    }

    strings.raw = raw;
    return strings;
  }

  function _temporalRef(val, name) {
    if (val === _temporalUndefined) {
      throw new ReferenceError(name + ' is not defined - temporal dead zone');
    } else {
      return val;
    }
  }

  function _readOnlyError(name) {
    throw new Error('"' + name + '" is read-only');
  }

  function _classNameTDZError(name) {
    throw new Error(
      'Class "' + name + '" cannot be referenced in computed property keys.'
    );
  }

  var _temporalUndefined = {};

  function _slicedToArray(arr, i) {
    return (
      _arrayWithHoles(arr) ||
      _iterableToArrayLimit(arr, i) ||
      _nonIterableRest()
    );
  }

  function _slicedToArrayLoose(arr, i) {
    return (
      _arrayWithHoles(arr) ||
      _iterableToArrayLimitLoose(arr, i) ||
      _nonIterableRest()
    );
  }

  function _toArray(arr) {
    return _arrayWithHoles(arr) || _iterableToArray(arr) || _nonIterableRest();
  }

  function _toConsumableArray(arr) {
    return (
      _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread()
    );
  }

  function _arrayWithoutHoles(arr) {
    if (Array.isArray(arr)) {
      for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++)
        arr2[i] = arr[i];

      return arr2;
    }
  }

  function _arrayWithHoles(arr) {
    if (Array.isArray(arr)) return arr;
  }

  function _iterableToArray(iter) {
    if (
      Symbol.iterator in Object(iter) ||
      Object.prototype.toString.call(iter) === '[object Arguments]'
    )
      return Array.from(iter);
  }

  function _iterableToArrayLimit(arr, i) {
    var _arr = [];
    var _n = true;
    var _d = false;
    var _e = undefined;

    try {
      for (
        var _i = arr[Symbol.iterator](), _s;
        !(_n = (_s = _i.next()).done);
        _n = true
      ) {
        _arr.push(_s.value);

        if (i && _arr.length === i) break;
      }
    } catch (err) {
      _d = true;
      _e = err;
    } finally {
      try {
        if (!_n && _i['return'] != null) _i['return']();
      } finally {
        if (_d) throw _e;
      }
    }

    return _arr;
  }

  function _iterableToArrayLimitLoose(arr, i) {
    var _arr = [];

    for (
      var _iterator = arr[Symbol.iterator](), _step;
      !(_step = _iterator.next()).done;

    ) {
      _arr.push(_step.value);

      if (i && _arr.length === i) break;
    }

    return _arr;
  }

  function _nonIterableSpread() {
    throw new TypeError('Invalid attempt to spread non-iterable instance');
  }

  function _nonIterableRest() {
    throw new TypeError('Invalid attempt to destructure non-iterable instance');
  }

  function _skipFirstGeneratorNext(fn) {
    return function() {
      var it = fn.apply(this, arguments);
      it.next();
      return it;
    };
  }

  function _toPrimitive(input, hint) {
    if (typeof input !== 'object' || input === null) return input;
    var prim = input[Symbol.toPrimitive];

    if (prim !== undefined) {
      var res = prim.call(input, hint || 'default');
      if (typeof res !== 'object') return res;
      throw new TypeError('@@toPrimitive must return a primitive value.');
    }

    return (hint === 'string' ? String : Number)(input);
  }

  function _toPropertyKey(arg) {
    var key = _toPrimitive(arg, 'string');

    return typeof key === 'symbol' ? key : String(key);
  }

  function _initializerWarningHelper(descriptor, context) {
    throw new Error(
      'Decorating class property failed. Please ensure that ' +
        'proposal-class-properties is enabled and set to use loose mode. ' +
        'To use proposal-class-properties in spec mode with decorators, wait for ' +
        'the next major version of decorators in stage 2.'
    );
  }

  function _initializerDefineProperty(target, property, descriptor, context) {
    if (!descriptor) return;
    Object.defineProperty(target, property, {
      enumerable: descriptor.enumerable,
      configurable: descriptor.configurable,
      writable: descriptor.writable,
      value: descriptor.initializer
        ? descriptor.initializer.call(context)
        : void 0
    });
  }

  function _applyDecoratedDescriptor(
    target,
    property,
    decorators,
    descriptor,
    context
  ) {
    var desc = {};
    Object.keys(descriptor).forEach(function(key) {
      desc[key] = descriptor[key];
    });
    desc.enumerable = !!desc.enumerable;
    desc.configurable = !!desc.configurable;

    if ('value' in desc || desc.initializer) {
      desc.writable = true;
    }

    desc = decorators
      .slice()
      .reverse()
      .reduce(function(desc, decorator) {
        return decorator(target, property, desc) || desc;
      }, desc);

    if (context && desc.initializer !== void 0) {
      desc.value = desc.initializer ? desc.initializer.call(context) : void 0;
      desc.initializer = undefined;
    }

    if (desc.initializer === void 0) {
      Object.defineProperty(target, property, desc);
      desc = null;
    }

    return desc;
  }

  var id = 0;

  function _classPrivateFieldLooseKey(name) {
    return '__private_' + id++ + '_' + name;
  }

  function _classPrivateFieldLooseBase(receiver, privateKey) {
    if (!Object.prototype.hasOwnProperty.call(receiver, privateKey)) {
      throw new TypeError('attempted to use private field on non-instance');
    }

    return receiver;
  }

  function _classPrivateFieldGet(receiver, privateMap) {
    if (!privateMap.has(receiver)) {
      throw new TypeError('attempted to get private field on non-instance');
    }

    var descriptor = privateMap.get(receiver);

    if (descriptor.get) {
      return descriptor.get.call(receiver);
    }

    return descriptor.value;
  }

  function _classPrivateFieldSet(receiver, privateMap, value) {
    if (!privateMap.has(receiver)) {
      throw new TypeError('attempted to set private field on non-instance');
    }

    var descriptor = privateMap.get(receiver);

    if (descriptor.set) {
      descriptor.set.call(receiver, value);
    } else {
      if (!descriptor.writable) {
        throw new TypeError('attempted to set read only private field');
      }

      descriptor.value = value;
    }

    return value;
  }

  function _classStaticPrivateFieldSpecGet(
    receiver,
    classConstructor,
    descriptor
  ) {
    if (receiver !== classConstructor) {
      throw new TypeError('Private static access of wrong provenance');
    }

    return descriptor.value;
  }

  function _classStaticPrivateFieldSpecSet(
    receiver,
    classConstructor,
    descriptor,
    value
  ) {
    if (receiver !== classConstructor) {
      throw new TypeError('Private static access of wrong provenance');
    }

    if (!descriptor.writable) {
      throw new TypeError('attempted to set read only private field');
    }

    descriptor.value = value;
    return value;
  }

  function _classStaticPrivateMethodGet(receiver, classConstructor, method) {
    if (receiver !== classConstructor) {
      throw new TypeError('Private static access of wrong provenance');
    }

    return method;
  }

  function _classStaticPrivateMethodSet() {
    throw new TypeError('attempted to set read only static private field');
  }

  function _decorate(decorators, factory, superClass, mixins) {
    var api = _getDecoratorsApi();

    if (mixins) {
      for (var i = 0; i < mixins.length; i++) {
        api = mixins[i](api);
      }
    }

    var r = factory(function initialize(O) {
      api.initializeInstanceElements(O, decorated.elements);
    }, superClass);
    var decorated = api.decorateClass(
      _coalesceClassElements(r.d.map(_createElementDescriptor)),
      decorators
    );
    api.initializeClassElements(r.F, decorated.elements);
    return api.runClassFinishers(r.F, decorated.finishers);
  }

  function _getDecoratorsApi() {
    _getDecoratorsApi = function() {
      return api;
    };

    var api = {
      elementsDefinitionOrder: [['method'], ['field']],
      initializeInstanceElements: function(O, elements) {
        ['method', 'field'].forEach(function(kind) {
          elements.forEach(function(element) {
            if (element.kind === kind && element.placement === 'own') {
              this.defineClassElement(O, element);
            }
          }, this);
        }, this);
      },
      initializeClassElements: function(F, elements) {
        var proto = F.prototype;
        ['method', 'field'].forEach(function(kind) {
          elements.forEach(function(element) {
            var placement = element.placement;

            if (
              element.kind === kind &&
              (placement === 'static' || placement === 'prototype')
            ) {
              var receiver = placement === 'static' ? F : proto;
              this.defineClassElement(receiver, element);
            }
          }, this);
        }, this);
      },
      defineClassElement: function(receiver, element) {
        var descriptor = element.descriptor;

        if (element.kind === 'field') {
          var initializer = element.initializer;
          descriptor = {
            enumerable: descriptor.enumerable,
            writable: descriptor.writable,
            configurable: descriptor.configurable,
            value: initializer === void 0 ? void 0 : initializer.call(receiver)
          };
        }

        Object.defineProperty(receiver, element.key, descriptor);
      },
      decorateClass: function(elements, decorators) {
        var newElements = [];
        var finishers = [];
        var placements = {
          static: [],
          prototype: [],
          own: []
        };
        elements.forEach(function(element) {
          this.addElementPlacement(element, placements);
        }, this);
        elements.forEach(function(element) {
          if (!_hasDecorators(element)) return newElements.push(element);
          var elementFinishersExtras = this.decorateElement(
            element,
            placements
          );
          newElements.push(elementFinishersExtras.element);
          newElements.push.apply(newElements, elementFinishersExtras.extras);
          finishers.push.apply(finishers, elementFinishersExtras.finishers);
        }, this);

        if (!decorators) {
          return {
            elements: newElements,
            finishers: finishers
          };
        }

        var result = this.decorateConstructor(newElements, decorators);
        finishers.push.apply(finishers, result.finishers);
        result.finishers = finishers;
        return result;
      },
      addElementPlacement: function(element, placements, silent) {
        var keys = placements[element.placement];

        if (!silent && keys.indexOf(element.key) !== -1) {
          throw new TypeError('Duplicated element (' + element.key + ')');
        }

        keys.push(element.key);
      },
      decorateElement: function(element, placements) {
        var extras = [];
        var finishers = [];

        for (
          var decorators = element.decorators, i = decorators.length - 1;
          i >= 0;
          i--
        ) {
          var keys = placements[element.placement];
          keys.splice(keys.indexOf(element.key), 1);
          var elementObject = this.fromElementDescriptor(element);
          var elementFinisherExtras = this.toElementFinisherExtras(
            (0, decorators[i])(elementObject) || elementObject
          );
          element = elementFinisherExtras.element;
          this.addElementPlacement(element, placements);

          if (elementFinisherExtras.finisher) {
            finishers.push(elementFinisherExtras.finisher);
          }

          var newExtras = elementFinisherExtras.extras;

          if (newExtras) {
            for (var j = 0; j < newExtras.length; j++) {
              this.addElementPlacement(newExtras[j], placements);
            }

            extras.push.apply(extras, newExtras);
          }
        }

        return {
          element: element,
          finishers: finishers,
          extras: extras
        };
      },
      decorateConstructor: function(elements, decorators) {
        var finishers = [];

        for (var i = decorators.length - 1; i >= 0; i--) {
          var obj = this.fromClassDescriptor(elements);
          var elementsAndFinisher = this.toClassDescriptor(
            (0, decorators[i])(obj) || obj
          );

          if (elementsAndFinisher.finisher !== undefined) {
            finishers.push(elementsAndFinisher.finisher);
          }

          if (elementsAndFinisher.elements !== undefined) {
            elements = elementsAndFinisher.elements;

            for (var j = 0; j < elements.length - 1; j++) {
              for (var k = j + 1; k < elements.length; k++) {
                if (
                  elements[j].key === elements[k].key &&
                  elements[j].placement === elements[k].placement
                ) {
                  throw new TypeError(
                    'Duplicated element (' + elements[j].key + ')'
                  );
                }
              }
            }
          }
        }

        return {
          elements: elements,
          finishers: finishers
        };
      },
      fromElementDescriptor: function(element) {
        var obj = {
          kind: element.kind,
          key: element.key,
          placement: element.placement,
          descriptor: element.descriptor
        };
        var desc = {
          value: 'Descriptor',
          configurable: true
        };
        Object.defineProperty(obj, Symbol.toStringTag, desc);
        if (element.kind === 'field') obj.initializer = element.initializer;
        return obj;
      },
      toElementDescriptors: function(elementObjects) {
        if (elementObjects === undefined) return;
        return _toArray(elementObjects).map(function(elementObject) {
          var element = this.toElementDescriptor(elementObject);
          this.disallowProperty(
            elementObject,
            'finisher',
            'An element descriptor'
          );
          this.disallowProperty(
            elementObject,
            'extras',
            'An element descriptor'
          );
          return element;
        }, this);
      },
      toElementDescriptor: function(elementObject) {
        var kind = String(elementObject.kind);

        if (kind !== 'method' && kind !== 'field') {
          throw new TypeError(
            'An element descriptor\'s .kind property must be either "method" or' +
              ' "field", but a decorator created an element descriptor with' +
              ' .kind "' +
              kind +
              '"'
          );
        }

        var key = _toPropertyKey(elementObject.key);

        var placement = String(elementObject.placement);

        if (
          placement !== 'static' &&
          placement !== 'prototype' &&
          placement !== 'own'
        ) {
          throw new TypeError(
            'An element descriptor\'s .placement property must be one of "static",' +
              ' "prototype" or "own", but a decorator created an element descriptor' +
              ' with .placement "' +
              placement +
              '"'
          );
        }

        var descriptor = elementObject.descriptor;
        this.disallowProperty(
          elementObject,
          'elements',
          'An element descriptor'
        );
        var element = {
          kind: kind,
          key: key,
          placement: placement,
          descriptor: Object.assign({}, descriptor)
        };

        if (kind !== 'field') {
          this.disallowProperty(
            elementObject,
            'initializer',
            'A method descriptor'
          );
        } else {
          this.disallowProperty(
            descriptor,
            'get',
            'The property descriptor of a field descriptor'
          );
          this.disallowProperty(
            descriptor,
            'set',
            'The property descriptor of a field descriptor'
          );
          this.disallowProperty(
            descriptor,
            'value',
            'The property descriptor of a field descriptor'
          );
          element.initializer = elementObject.initializer;
        }

        return element;
      },
      toElementFinisherExtras: function(elementObject) {
        var element = this.toElementDescriptor(elementObject);

        var finisher = _optionalCallableProperty(elementObject, 'finisher');

        var extras = this.toElementDescriptors(elementObject.extras);
        return {
          element: element,
          finisher: finisher,
          extras: extras
        };
      },
      fromClassDescriptor: function(elements) {
        var obj = {
          kind: 'class',
          elements: elements.map(this.fromElementDescriptor, this)
        };
        var desc = {
          value: 'Descriptor',
          configurable: true
        };
        Object.defineProperty(obj, Symbol.toStringTag, desc);
        return obj;
      },
      toClassDescriptor: function(obj) {
        var kind = String(obj.kind);

        if (kind !== 'class') {
          throw new TypeError(
            'A class descriptor\'s .kind property must be "class", but a decorator' +
              ' created a class descriptor with .kind "' +
              kind +
              '"'
          );
        }

        this.disallowProperty(obj, 'key', 'A class descriptor');
        this.disallowProperty(obj, 'placement', 'A class descriptor');
        this.disallowProperty(obj, 'descriptor', 'A class descriptor');
        this.disallowProperty(obj, 'initializer', 'A class descriptor');
        this.disallowProperty(obj, 'extras', 'A class descriptor');

        var finisher = _optionalCallableProperty(obj, 'finisher');

        var elements = this.toElementDescriptors(obj.elements);
        return {
          elements: elements,
          finisher: finisher
        };
      },
      runClassFinishers: function(constructor, finishers) {
        for (var i = 0; i < finishers.length; i++) {
          var newConstructor = (0, finishers[i])(constructor);

          if (newConstructor !== undefined) {
            if (typeof newConstructor !== 'function') {
              throw new TypeError('Finishers must return a constructor.');
            }

            constructor = newConstructor;
          }
        }

        return constructor;
      },
      disallowProperty: function(obj, name, objectType) {
        if (obj[name] !== undefined) {
          throw new TypeError(
            objectType + " can't have a ." + name + ' property.'
          );
        }
      }
    };
    return api;
  }

  function _createElementDescriptor(def) {
    var key = _toPropertyKey(def.key);

    var descriptor;

    if (def.kind === 'method') {
      descriptor = {
        value: def.value,
        writable: true,
        configurable: true,
        enumerable: false
      };
    } else if (def.kind === 'get') {
      descriptor = {
        get: def.value,
        configurable: true,
        enumerable: false
      };
    } else if (def.kind === 'set') {
      descriptor = {
        set: def.value,
        configurable: true,
        enumerable: false
      };
    } else if (def.kind === 'field') {
      descriptor = {
        configurable: true,
        writable: true,
        enumerable: true
      };
    }

    var element = {
      kind: def.kind === 'field' ? 'field' : 'method',
      key: key,
      placement: def.static
        ? 'static'
        : def.kind === 'field'
        ? 'own'
        : 'prototype',
      descriptor: descriptor
    };
    if (def.decorators) element.decorators = def.decorators;
    if (def.kind === 'field') element.initializer = def.value;
    return element;
  }

  function _coalesceGetterSetter(element, other) {
    if (element.descriptor.get !== undefined) {
      other.descriptor.get = element.descriptor.get;
    } else {
      other.descriptor.set = element.descriptor.set;
    }
  }

  function _coalesceClassElements(elements) {
    var newElements = [];

    var isSameElement = function(other) {
      return (
        other.kind === 'method' &&
        other.key === element.key &&
        other.placement === element.placement
      );
    };

    for (var i = 0; i < elements.length; i++) {
      var element = elements[i];
      var other;

      if (
        element.kind === 'method' &&
        (other = newElements.find(isSameElement))
      ) {
        if (
          _isDataDescriptor(element.descriptor) ||
          _isDataDescriptor(other.descriptor)
        ) {
          if (_hasDecorators(element) || _hasDecorators(other)) {
            throw new ReferenceError(
              'Duplicated methods (' + element.key + ") can't be decorated."
            );
          }

          other.descriptor = element.descriptor;
        } else {
          if (_hasDecorators(element)) {
            if (_hasDecorators(other)) {
              throw new ReferenceError(
                "Decorators can't be placed on different accessors with for " +
                  'the same property (' +
                  element.key +
                  ').'
              );
            }

            other.decorators = element.decorators;
          }

          _coalesceGetterSetter(element, other);
        }
      } else {
        newElements.push(element);
      }
    }

    return newElements;
  }

  function _hasDecorators(element) {
    return element.decorators && element.decorators.length;
  }

  function _isDataDescriptor(desc) {
    return (
      desc !== undefined &&
      !(desc.value === undefined && desc.writable === undefined)
    );
  }

  function _optionalCallableProperty(obj, name) {
    var value = obj[name];

    if (value !== undefined && typeof value !== 'function') {
      throw new TypeError("Expected '" + name + "' to be a function");
    }

    return value;
  }

  function _classPrivateMethodGet(receiver, privateSet, fn) {
    if (!privateSet.has(receiver)) {
      throw new TypeError('attempted to get private field on non-instance');
    }

    return fn;
  }

  function _classPrivateMethodSet() {
    throw new TypeError('attempted to reassign private method');
  }

  function _wrapRegExp(re, groups) {
    _wrapRegExp = function(re, groups) {
      return new BabelRegExp(re, groups);
    };

    var _RegExp = _wrapNativeSuper(RegExp);

    var _super = RegExp.prototype;

    var _groups = new WeakMap();

    function BabelRegExp(re, groups) {
      var _this = _RegExp.call(this, re);

      _groups.set(_this, groups);

      return _this;
    }

    _inherits(BabelRegExp, _RegExp);

    BabelRegExp.prototype.exec = function(str) {
      var result = _super.exec.call(this, str);

      if (result) result.groups = buildGroups(result, this);
      return result;
    };

    BabelRegExp.prototype[Symbol.replace] = function(str, substitution) {
      if (typeof substitution === 'string') {
        var groups = _groups.get(this);

        return _super[Symbol.replace].call(
          this,
          str,
          substitution.replace(/\$<([^>]+)>/g, function(_, name) {
            return '$' + groups[name];
          })
        );
      } else if (typeof substitution === 'function') {
        var _this = this;

        return _super[Symbol.replace].call(this, str, function() {
          var args = [];
          args.push.apply(args, arguments);

          if (typeof args[args.length - 1] !== 'object') {
            args.push(buildGroups(args, _this));
          }

          return substitution.apply(this, args);
        });
      } else {
        return _super[Symbol.replace].call(this, str, substitution);
      }
    };

    function buildGroups(result, re) {
      var g = _groups.get(re);

      return Object.keys(g).reduce(function(groups, name) {
        groups[name] = result[g[name]];
        return groups;
      }, Object.create(null));
    }

    return _wrapRegExp.apply(this, arguments);
  }

  var vectorMultiply = function vectorMultiply(v, amount) {
    return createVector(v.x * amount, v.y * amount);
  };

  var vectorAdd = function vectorAdd(a, b) {
    return createVector(a.x + b.x, a.y + b.y);
  };

  var vectorNormalize = function vectorNormalize(v) {
    var l = Math.sqrt(v.x * v.x + v.y * v.y);
    if (l === 0) {
      return {
        x: 0,
        y: 0
      };
    }
    return createVector(v.x / l, v.y / l);
  };

  var vectorRotate = function vectorRotate(v, radians, origin) {
    var cos = Math.cos(radians);
    var sin = Math.sin(radians);
    var t = createVector(v.x - origin.x, v.y - origin.y);
    return createVector(
      origin.x + cos * t.x - sin * t.y,
      origin.y + sin * t.x + cos * t.y
    );
  };

  var createVector = function createVector() {
    var x =
      arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
    var y =
      arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
    return { x: x, y: y };
  };

  var getMarkupValue = function getMarkupValue(value, size) {
    var scalar =
      arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 1;
    var axis = arguments.length > 3 ? arguments[3] : undefined;
    if (typeof value === 'string') {
      return parseFloat(value) * scalar;
    }
    if (typeof value === 'number') {
      return value * (axis ? size[axis] : Math.min(size.width, size.height));
    }
    return;
  };

  var getMarkupStyles = function getMarkupStyles(markup, size, scale) {
    var lineStyle = markup.borderStyle || markup.lineStyle || 'solid';
    var fill = markup.backgroundColor || markup.fontColor || 'transparent';
    var stroke = markup.borderColor || markup.lineColor || 'transparent';
    var strokeWidth = getMarkupValue(
      markup.borderWidth || markup.lineWidth,
      size,
      scale
    );
    var lineCap = markup.lineCap || 'round';
    var lineJoin = markup.lineJoin || 'round';
    var dashes =
      typeof lineStyle === 'string'
        ? ''
        : lineStyle
            .map(function(v) {
              return getMarkupValue(v, size, scale);
            })
            .join(',');
    var opacity = markup.opacity || 1;
    return {
      'stroke-linecap': lineCap,
      'stroke-linejoin': lineJoin,
      'stroke-width': strokeWidth || 0,
      'stroke-dasharray': dashes,
      stroke: stroke,
      fill: fill,
      opacity: opacity
    };
  };

  var isDefined = function isDefined(value) {
    return value != null;
  };

  var getMarkupRect = function getMarkupRect(rect, size) {
    var scalar =
      arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 1;

    var left =
      getMarkupValue(rect.x, size, scalar, 'width') ||
      getMarkupValue(rect.left, size, scalar, 'width');
    var top =
      getMarkupValue(rect.y, size, scalar, 'height') ||
      getMarkupValue(rect.top, size, scalar, 'height');
    var width = getMarkupValue(rect.width, size, scalar, 'width');
    var height = getMarkupValue(rect.height, size, scalar, 'height');
    var right = getMarkupValue(rect.right, size, scalar, 'width');
    var bottom = getMarkupValue(rect.bottom, size, scalar, 'height');

    if (!isDefined(top)) {
      if (isDefined(height) && isDefined(bottom)) {
        top = size.height - height - bottom;
      } else {
        top = bottom;
      }
    }

    if (!isDefined(left)) {
      if (isDefined(width) && isDefined(right)) {
        left = size.width - width - right;
      } else {
        left = right;
      }
    }

    if (!isDefined(width)) {
      if (isDefined(left) && isDefined(right)) {
        width = size.width - left - right;
      } else {
        width = 0;
      }
    }

    if (!isDefined(height)) {
      if (isDefined(top) && isDefined(bottom)) {
        height = size.height - top - bottom;
      } else {
        height = 0;
      }
    }

    return {
      x: left || 0,
      y: top || 0,
      width: width || 0,
      height: height || 0
    };
  };

  var pointsToPathShape = function pointsToPathShape(points) {
    return points
      .map(function(point, index) {
        return ''
          .concat(index === 0 ? 'M' : 'L', ' ')
          .concat(point.x, ' ')
          .concat(point.y);
      })
      .join(' ');
  };

  var setAttributes = function setAttributes(element, attr) {
    return Object.keys(attr).forEach(function(key) {
      return element.setAttribute(key, attr[key]);
    });
  };

  var ns = 'http://www.w3.org/2000/svg';
  var svg = function svg(tag, attr) {
    var element = document.createElementNS(ns, tag);
    if (attr) {
      setAttributes(element, attr);
    }
    return element;
  };

  var updateRect = function updateRect(element) {
    return setAttributes(
      element,
      Object.assign({}, element.rect, element.styles)
    );
  };

  var updateEllipse = function updateEllipse(element) {
    var cx = element.rect.x + element.rect.width * 0.5;
    var cy = element.rect.y + element.rect.height * 0.5;
    var rx = element.rect.width * 0.5;
    var ry = element.rect.height * 0.5;
    return setAttributes(
      element,
      Object.assign(
        {
          cx: cx,
          cy: cy,
          rx: rx,
          ry: ry
        },
        element.styles
      )
    );
  };

  var IMAGE_FIT_STYLE = {
    contain: 'xMidYMid meet',
    cover: 'xMidYMid slice'
  };

  var updateImage = function updateImage(element, markup) {
    setAttributes(
      element,
      Object.assign({}, element.rect, element.styles, {
        preserveAspectRatio: IMAGE_FIT_STYLE[markup.fit] || 'none'
      })
    );
  };

  var TEXT_ANCHOR = {
    left: 'start',
    center: 'middle',
    right: 'end'
  };

  var updateText = function updateText(element, markup, size, scale) {
    var fontSize = getMarkupValue(markup.fontSize, size, scale);
    var fontFamily = markup.fontFamily || 'sans-serif';
    var fontWeight = markup.fontWeight || 'normal';
    var textAlign = TEXT_ANCHOR[markup.textAlign] || 'start';

    setAttributes(
      element,
      Object.assign({}, element.rect, element.styles, {
        'stroke-width': 0,
        'font-weight': fontWeight,
        'font-size': fontSize,
        'font-family': fontFamily,
        'text-anchor': textAlign
      })
    );

    // update text
    if (element.text !== markup.text) {
      element.text = markup.text;
      element.textContent = markup.text.length ? markup.text : ' ';
    }
  };

  var updateLine = function updateLine(element, markup, size, scale) {
    setAttributes(
      element,
      Object.assign({}, element.rect, element.styles, {
        fill: 'none'
      })
    );

    var line = element.childNodes[0];
    var begin = element.childNodes[1];
    var end = element.childNodes[2];

    var origin = element.rect;

    var target = {
      x: element.rect.x + element.rect.width,
      y: element.rect.y + element.rect.height
    };

    setAttributes(line, {
      x1: origin.x,
      y1: origin.y,
      x2: target.x,
      y2: target.y
    });

    if (!markup.lineDecoration) return;

    begin.style.display = 'none';
    end.style.display = 'none';

    var v = vectorNormalize({
      x: target.x - origin.x,
      y: target.y - origin.y
    });

    var l = getMarkupValue(0.05, size, scale);

    if (markup.lineDecoration.indexOf('arrow-begin') !== -1) {
      var arrowBeginRotationPoint = vectorMultiply(v, l);
      var arrowBeginCenter = vectorAdd(origin, arrowBeginRotationPoint);
      var arrowBeginA = vectorRotate(origin, 2, arrowBeginCenter);
      var arrowBeginB = vectorRotate(origin, -2, arrowBeginCenter);

      setAttributes(begin, {
        style: 'display:block;',
        d: 'M'
          .concat(arrowBeginA.x, ',')
          .concat(arrowBeginA.y, ' L')
          .concat(origin.x, ',')
          .concat(origin.y, ' L')
          .concat(arrowBeginB.x, ',')
          .concat(arrowBeginB.y)
      });
    }

    if (markup.lineDecoration.indexOf('arrow-end') !== -1) {
      var arrowEndRotationPoint = vectorMultiply(v, -l);
      var arrowEndCenter = vectorAdd(target, arrowEndRotationPoint);
      var arrowEndA = vectorRotate(target, 2, arrowEndCenter);
      var arrowEndB = vectorRotate(target, -2, arrowEndCenter);

      setAttributes(end, {
        style: 'display:block;',
        d: 'M'
          .concat(arrowEndA.x, ',')
          .concat(arrowEndA.y, ' L')
          .concat(target.x, ',')
          .concat(target.y, ' L')
          .concat(arrowEndB.x, ',')
          .concat(arrowEndB.y)
      });
    }
  };

  var updatePath = function updatePath(element, markup, size, scale) {
    setAttributes(
      element,
      Object.assign({}, element.styles, {
        fill: 'none',
        d: pointsToPathShape(
          markup.points.map(function(point) {
            return {
              x: getMarkupValue(point.x, size, scale, 'width'),
              y: getMarkupValue(point.y, size, scale, 'height')
            };
          })
        )
      })
    );
  };

  var createShape = function createShape(node) {
    return function(markup) {
      return svg(node, { id: markup.id });
    };
  };

  var createImage = function createImage(markup) {
    var shape = svg('image', {
      id: markup.id,
      'stroke-linecap': 'round',
      'stroke-linejoin': 'round',
      opacity: '0'
    });

    shape.onload = function() {
      shape.setAttribute('opacity', markup.opacity || 1);
    };
    shape.setAttributeNS(
      'http://www.w3.org/1999/xlink',
      'xlink:href',
      markup.src
    );
    return shape;
  };

  var createLine = function createLine(markup) {
    var shape = svg('g', {
      id: markup.id,
      'stroke-linecap': 'round',
      'stroke-linejoin': 'round'
    });

    var line = svg('line');
    shape.appendChild(line);

    var begin = svg('path');
    shape.appendChild(begin);

    var end = svg('path');
    shape.appendChild(end);

    return shape;
  };

  var CREATE_TYPE_ROUTES = {
    image: createImage,
    rect: createShape('rect'),
    ellipse: createShape('ellipse'),
    text: createShape('text'),
    path: createShape('path'),
    line: createLine
  };

  var UPDATE_TYPE_ROUTES = {
    rect: updateRect,
    ellipse: updateEllipse,
    image: updateImage,
    text: updateText,
    path: updatePath,
    line: updateLine
  };

  var createMarkupByType = function createMarkupByType(type, markup) {
    return CREATE_TYPE_ROUTES[type](markup);
  };

  var updateMarkupByType = function updateMarkupByType(
    element,
    type,
    markup,
    size,
    scale
  ) {
    if (type !== 'path') {
      element.rect = getMarkupRect(markup, size, scale);
    }
    element.styles = getMarkupStyles(markup, size, scale);
    UPDATE_TYPE_ROUTES[type](element, markup, size, scale);
  };

  var MARKUP_RECT = [
    'x',
    'y',
    'left',
    'top',
    'right',
    'bottom',
    'width',
    'height'
  ];

  var toOptionalFraction = function toOptionalFraction(value) {
    return typeof value === 'string' && /%/.test(value)
      ? parseFloat(value) / 100
      : value;
  };

  // adds default markup properties, clones markup
  var prepareMarkup = function prepareMarkup(markup) {
    var _markup = _slicedToArray(markup, 2),
      type = _markup[0],
      props = _markup[1];

    var rect = props.points
      ? {}
      : MARKUP_RECT.reduce(function(prev, curr) {
          prev[curr] = toOptionalFraction(props[curr]);
          return prev;
        }, {});

    return [
      type,
      Object.assign(
        {
          zIndex: 0
        },
        props,
        rect
      )
    ];
  };

  var sortMarkupByZIndex = function sortMarkupByZIndex(a, b) {
    if (a[1].zIndex > b[1].zIndex) {
      return 1;
    }
    if (a[1].zIndex < b[1].zIndex) {
      return -1;
    }
    return 0;
  };

  var createMarkupView = function createMarkupView(_) {
    return _.utils.createView({
      name: 'image-preview-markup',
      tag: 'svg',
      ignoreRect: true,
      mixins: {
        apis: ['width', 'height', 'crop', 'markup', 'resize', 'dirty']
      },

      write: function write(_ref) {
        var root = _ref.root,
          props = _ref.props;

        if (!props.dirty) return;
        var crop = props.crop,
          resize = props.resize,
          markup = props.markup;

        var viewWidth = props.width;
        var viewHeight = props.height;

        var cropWidth = crop.width;
        var cropHeight = crop.height;

        if (resize) {
          var _size = resize.size;

          var outputWidth = _size && _size.width;
          var outputHeight = _size && _size.height;
          var outputFit = resize.mode;
          var outputUpscale = resize.upscale;

          if (outputWidth && !outputHeight) outputHeight = outputWidth;
          if (outputHeight && !outputWidth) outputWidth = outputHeight;

          var shouldUpscale =
            cropWidth < outputWidth && cropHeight < outputHeight;

          if (!shouldUpscale || (shouldUpscale && outputUpscale)) {
            var scalarWidth = outputWidth / cropWidth;
            var scalarHeight = outputHeight / cropHeight;

            if (outputFit === 'force') {
              cropWidth = outputWidth;
              cropHeight = outputHeight;
            } else {
              var scalar;
              if (outputFit === 'cover') {
                scalar = Math.max(scalarWidth, scalarHeight);
              } else if (outputFit === 'contain') {
                scalar = Math.min(scalarWidth, scalarHeight);
              }
              cropWidth = cropWidth * scalar;
              cropHeight = cropHeight * scalar;
            }
          }
        }

        var size = {
          width: viewWidth,
          height: viewHeight
        };

        root.element.setAttribute('width', size.width);
        root.element.setAttribute('height', size.height);

        var scale = Math.min(viewWidth / cropWidth, viewHeight / cropHeight);

        // clear
        root.element.innerHTML = '';

        // get filter
        var markupFilter = root.query('GET_IMAGE_PREVIEW_MARKUP_FILTER');

        // draw new
        markup
          .filter(markupFilter)
          .map(prepareMarkup)
          .sort(sortMarkupByZIndex)
          .forEach(function(markup) {
            var _markup = _slicedToArray(markup, 2),
              type = _markup[0],
              settings = _markup[1];

            // create
            var element = createMarkupByType(type, settings);

            // update
            updateMarkupByType(element, type, settings, size, scale);

            // add
            root.element.appendChild(element);
          });
      }
    });
  };

  var createVector$1 = function createVector(x, y) {
    return { x: x, y: y };
  };

  var vectorDot = function vectorDot(a, b) {
    return a.x * b.x + a.y * b.y;
  };

  var vectorSubtract = function vectorSubtract(a, b) {
    return createVector$1(a.x - b.x, a.y - b.y);
  };

  var vectorDistanceSquared = function vectorDistanceSquared(a, b) {
    return vectorDot(vectorSubtract(a, b), vectorSubtract(a, b));
  };

  var vectorDistance = function vectorDistance(a, b) {
    return Math.sqrt(vectorDistanceSquared(a, b));
  };

  var getOffsetPointOnEdge = function getOffsetPointOnEdge(length, rotation) {
    var a = length;

    var A = 1.5707963267948966;
    var B = rotation;
    var C = 1.5707963267948966 - rotation;

    var sinA = Math.sin(A);
    var sinB = Math.sin(B);
    var sinC = Math.sin(C);
    var cosC = Math.cos(C);
    var ratio = a / sinA;
    var b = ratio * sinB;
    var c = ratio * sinC;

    return createVector$1(cosC * b, cosC * c);
  };

  var getRotatedRectSize = function getRotatedRectSize(rect, rotation) {
    var w = rect.width;
    var h = rect.height;

    var hor = getOffsetPointOnEdge(w, rotation);
    var ver = getOffsetPointOnEdge(h, rotation);

    var tl = createVector$1(rect.x + Math.abs(hor.x), rect.y - Math.abs(hor.y));

    var tr = createVector$1(
      rect.x + rect.width + Math.abs(ver.y),
      rect.y + Math.abs(ver.x)
    );

    var bl = createVector$1(
      rect.x - Math.abs(ver.y),
      rect.y + rect.height - Math.abs(ver.x)
    );

    return {
      width: vectorDistance(tl, tr),
      height: vectorDistance(tl, bl)
    };
  };

  var calculateCanvasSize = function calculateCanvasSize(
    image,
    canvasAspectRatio
  ) {
    var zoom =
      arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 1;

    var imageAspectRatio = image.height / image.width;

    // determine actual pixels on x and y axis
    var canvasWidth = 1;
    var canvasHeight = canvasAspectRatio;
    var imgWidth = 1;
    var imgHeight = imageAspectRatio;
    if (imgHeight > canvasHeight) {
      imgHeight = canvasHeight;
      imgWidth = imgHeight / imageAspectRatio;
    }

    var scalar = Math.max(canvasWidth / imgWidth, canvasHeight / imgHeight);
    var width = image.width / (zoom * scalar * imgWidth);
    var height = width * canvasAspectRatio;

    return {
      width: width,
      height: height
    };
  };

  var getImageRectZoomFactor = function getImageRectZoomFactor(
    imageRect,
    cropRect,
    rotation,
    center
  ) {
    // calculate available space round image center position
    var cx = center.x > 0.5 ? 1 - center.x : center.x;
    var cy = center.y > 0.5 ? 1 - center.y : center.y;
    var imageWidth = cx * 2 * imageRect.width;
    var imageHeight = cy * 2 * imageRect.height;

    // calculate rotated crop rectangle size
    var rotatedCropSize = getRotatedRectSize(cropRect, rotation);

    // calculate scalar required to fit image
    return Math.max(
      rotatedCropSize.width / imageWidth,
      rotatedCropSize.height / imageHeight
    );
  };

  var getCenteredCropRect = function getCenteredCropRect(
    container,
    aspectRatio
  ) {
    var width = container.width;
    var height = width * aspectRatio;
    if (height > container.height) {
      height = container.height;
      width = height / aspectRatio;
    }
    var x = (container.width - width) * 0.5;
    var y = (container.height - height) * 0.5;

    return {
      x: x,
      y: y,
      width: width,
      height: height
    };
  };

  var getCurrentCropSize = function getCurrentCropSize(imageSize) {
    var crop =
      arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var zoom = crop.zoom,
      rotation = crop.rotation,
      center = crop.center,
      aspectRatio = crop.aspectRatio;

    if (!aspectRatio) aspectRatio = imageSize.height / imageSize.width;

    var canvasSize = calculateCanvasSize(imageSize, aspectRatio, zoom);

    var canvasCenter = {
      x: canvasSize.width * 0.5,
      y: canvasSize.height * 0.5
    };

    var stage = {
      x: 0,
      y: 0,
      width: canvasSize.width,
      height: canvasSize.height,
      center: canvasCenter
    };

    var shouldLimit = typeof crop.scaleToFit === 'undefined' || crop.scaleToFit;

    var stageZoomFactor = getImageRectZoomFactor(
      imageSize,
      getCenteredCropRect(stage, aspectRatio),
      rotation,
      shouldLimit ? center : { x: 0.5, y: 0.5 }
    );

    var scale = zoom * stageZoomFactor;

    // start drawing
    return {
      widthFloat: canvasSize.width / scale,
      heightFloat: canvasSize.height / scale,
      width: Math.round(canvasSize.width / scale),
      height: Math.round(canvasSize.height / scale)
    };
  };

  var IMAGE_SCALE_SPRING_PROPS = {
    type: 'spring',
    stiffness: 0.5,
    damping: 0.45,
    mass: 10
  };

  // does horizontal and vertical flipping
  var createBitmapView = function createBitmapView(_) {
    return _.utils.createView({
      name: 'image-bitmap',
      ignoreRect: true,
      mixins: { styles: ['scaleX', 'scaleY'] },
      create: function create(_ref) {
        var root = _ref.root,
          props = _ref.props;
        root.appendChild(props.image);
      }
    });
  };

  // shifts and rotates image
  var createImageCanvasWrapper = function createImageCanvasWrapper(_) {
    return _.utils.createView({
      name: 'image-canvas-wrapper',
      tag: 'div',
      ignoreRect: true,
      mixins: {
        apis: ['crop', 'width', 'height'],

        styles: [
          'originX',
          'originY',
          'translateX',
          'translateY',
          'scaleX',
          'scaleY',
          'rotateZ'
        ],

        animations: {
          originX: IMAGE_SCALE_SPRING_PROPS,
          originY: IMAGE_SCALE_SPRING_PROPS,
          scaleX: IMAGE_SCALE_SPRING_PROPS,
          scaleY: IMAGE_SCALE_SPRING_PROPS,
          translateX: IMAGE_SCALE_SPRING_PROPS,
          translateY: IMAGE_SCALE_SPRING_PROPS,
          rotateZ: IMAGE_SCALE_SPRING_PROPS
        }
      },

      create: function create(_ref2) {
        var root = _ref2.root,
          props = _ref2.props;
        props.width = props.image.width;
        props.height = props.image.height;
        root.ref.bitmap = root.appendChildView(
          root.createChildView(createBitmapView(_), { image: props.image })
        );
      },
      write: function write(_ref3) {
        var root = _ref3.root,
          props = _ref3.props;
        var flip = props.crop.flip;
        var bitmap = root.ref.bitmap;
        bitmap.scaleX = flip.horizontal ? -1 : 1;
        bitmap.scaleY = flip.vertical ? -1 : 1;
      }
    });
  };

  // clips canvas to correct aspect ratio
  var createClipView = function createClipView(_) {
    return _.utils.createView({
      name: 'image-clip',
      tag: 'div',
      ignoreRect: true,
      mixins: {
        apis: [
          'crop',
          'markup',
          'resize',
          'width',
          'height',
          'dirty',
          'background'
        ],

        styles: ['width', 'height', 'opacity'],
        animations: {
          opacity: { type: 'tween', duration: 250 }
        }
      },

      didWriteView: function didWriteView(_ref4) {
        var root = _ref4.root,
          props = _ref4.props;
        if (!props.background) return;
        root.element.style.backgroundColor = props.background;
      },
      create: function create(_ref5) {
        var root = _ref5.root,
          props = _ref5.props;

        root.ref.image = root.appendChildView(
          root.createChildView(
            createImageCanvasWrapper(_),
            Object.assign({}, props)
          )
        );

        root.ref.createMarkup = function() {
          if (root.ref.markup) return;
          root.ref.markup = root.appendChildView(
            root.createChildView(createMarkupView(_), Object.assign({}, props))
          );
        };

        root.ref.destroyMarkup = function() {
          if (!root.ref.markup) return;
          root.removeChildView(root.ref.markup);
          root.ref.markup = null;
        };

        // set up transparency grid
        var transparencyIndicator = root.query(
          'GET_IMAGE_PREVIEW_TRANSPARENCY_INDICATOR'
        );
        if (transparencyIndicator === null) return;

        // grid pattern
        if (transparencyIndicator === 'grid') {
          root.element.dataset.transparencyIndicator = transparencyIndicator;
        }
        // basic color
        else {
          root.element.dataset.transparencyIndicator = 'color';
        }
      },
      write: function write(_ref6) {
        var root = _ref6.root,
          props = _ref6.props,
          shouldOptimize = _ref6.shouldOptimize;
        var crop = props.crop,
          markup = props.markup,
          resize = props.resize,
          dirty = props.dirty,
          width = props.width,
          height = props.height;

        root.ref.image.crop = crop;

        var stage = {
          x: 0,
          y: 0,
          width: width,
          height: height,
          center: {
            x: width * 0.5,
            y: height * 0.5
          }
        };

        var image = {
          width: root.ref.image.width,
          height: root.ref.image.height
        };

        var origin = {
          x: crop.center.x * image.width,
          y: crop.center.y * image.height
        };

        var translation = {
          x: stage.center.x - image.width * crop.center.x,
          y: stage.center.y - image.height * crop.center.y
        };

        var rotation = Math.PI * 2 + (crop.rotation % (Math.PI * 2));

        var cropAspectRatio = crop.aspectRatio || image.height / image.width;

        var shouldLimit =
          typeof crop.scaleToFit === 'undefined' || crop.scaleToFit;

        var stageZoomFactor = getImageRectZoomFactor(
          image,
          getCenteredCropRect(stage, cropAspectRatio),

          rotation,
          shouldLimit ? crop.center : { x: 0.5, y: 0.5 }
        );

        var scale = crop.zoom * stageZoomFactor;

        // update markup view
        if (markup && markup.length) {
          root.ref.createMarkup();
          root.ref.markup.width = width;
          root.ref.markup.height = height;
          root.ref.markup.resize = resize;
          root.ref.markup.dirty = dirty;
          root.ref.markup.markup = markup;
          root.ref.markup.crop = getCurrentCropSize(image, crop);
        } else if (root.ref.markup) {
          root.ref.destroyMarkup();
        }

        // update image view
        var imageView = root.ref.image;

        // don't update clip layout
        if (shouldOptimize) {
          imageView.originX = null;
          imageView.originY = null;
          imageView.translateX = null;
          imageView.translateY = null;
          imageView.rotateZ = null;
          imageView.scaleX = null;
          imageView.scaleY = null;
          return;
        }

        imageView.originX = origin.x;
        imageView.originY = origin.y;
        imageView.translateX = translation.x;
        imageView.translateY = translation.y;
        imageView.rotateZ = rotation;
        imageView.scaleX = scale;
        imageView.scaleY = scale;
      }
    });
  };

  var createImageView = function createImageView(_) {
    return _.utils.createView({
      name: 'image-preview',
      tag: 'div',
      ignoreRect: true,
      mixins: {
        apis: ['image', 'crop', 'markup', 'resize', 'dirty', 'background'],

        styles: ['translateY', 'scaleX', 'scaleY', 'opacity'],

        animations: {
          scaleX: IMAGE_SCALE_SPRING_PROPS,
          scaleY: IMAGE_SCALE_SPRING_PROPS,
          translateY: IMAGE_SCALE_SPRING_PROPS,
          opacity: { type: 'tween', duration: 400 }
        }
      },

      create: function create(_ref7) {
        var root = _ref7.root,
          props = _ref7.props;
        root.ref.clip = root.appendChildView(
          root.createChildView(createClipView(_), {
            id: props.id,
            image: props.image,
            crop: props.crop,
            markup: props.markup,
            resize: props.resize,
            dirty: props.dirty,
            background: props.background
          })
        );
      },
      write: function write(_ref8) {
        var root = _ref8.root,
          props = _ref8.props,
          shouldOptimize = _ref8.shouldOptimize;
        var clip = root.ref.clip;
        var image = props.image,
          crop = props.crop,
          markup = props.markup,
          resize = props.resize,
          dirty = props.dirty;

        clip.crop = crop;
        clip.markup = markup;
        clip.resize = resize;
        clip.dirty = dirty;

        // don't update clip layout
        clip.opacity = shouldOptimize ? 0 : 1;

        // don't re-render if optimizing or hidden (width will be zero resulting in weird animations)
        if (shouldOptimize || root.rect.element.hidden) return;

        // calculate scaled preview image size
        var imageAspectRatio = image.height / image.width;
        var aspectRatio = crop.aspectRatio || imageAspectRatio;

        // calculate container size
        var containerWidth = root.rect.inner.width;
        var containerHeight = root.rect.inner.height;

        var fixedPreviewHeight = root.query('GET_IMAGE_PREVIEW_HEIGHT');
        var minPreviewHeight = root.query('GET_IMAGE_PREVIEW_MIN_HEIGHT');
        var maxPreviewHeight = root.query('GET_IMAGE_PREVIEW_MAX_HEIGHT');

        var panelAspectRatio = root.query('GET_PANEL_ASPECT_RATIO');
        var allowMultiple = root.query('GET_ALLOW_MULTIPLE');

        if (panelAspectRatio && !allowMultiple) {
          fixedPreviewHeight = containerWidth * panelAspectRatio;
          aspectRatio = panelAspectRatio;
        }

        // determine clip width and height
        var clipHeight =
          fixedPreviewHeight !== null
            ? fixedPreviewHeight
            : Math.max(
                minPreviewHeight,
                Math.min(containerWidth * aspectRatio, maxPreviewHeight)
              );

        var clipWidth = clipHeight / aspectRatio;
        if (clipWidth > containerWidth) {
          clipWidth = containerWidth;
          clipHeight = clipWidth * aspectRatio;
        }

        if (clipHeight > containerHeight) {
          clipHeight = containerHeight;
          clipWidth = containerHeight / aspectRatio;
        }

        clip.width = clipWidth;
        clip.height = clipHeight;
      }
    });
  };

  var SVG_MASK =
    '<svg width="500" height="200" viewBox="0 0 500 200" preserveAspectRatio="none">\n    <defs>\n        <radialGradient id="gradient-__UID__" cx=".5" cy="1.25" r="1.15">\n            <stop offset=\'50%\' stop-color=\'#000000\'/>\n            <stop offset=\'56%\' stop-color=\'#0a0a0a\'/>\n            <stop offset=\'63%\' stop-color=\'#262626\'/>\n            <stop offset=\'69%\' stop-color=\'#4f4f4f\'/>\n            <stop offset=\'75%\' stop-color=\'#808080\'/>\n            <stop offset=\'81%\' stop-color=\'#b1b1b1\'/>\n            <stop offset=\'88%\' stop-color=\'#dadada\'/>\n            <stop offset=\'94%\' stop-color=\'#f6f6f6\'/>\n            <stop offset=\'100%\' stop-color=\'#ffffff\'/>\n        </radialGradient>\n        <mask id="mask-__UID__">\n            <rect x="0" y="0" width="500" height="200" fill="url(#gradient-__UID__)"></rect>\n        </mask>\n    </defs>\n    <rect x="0" width="500" height="200" fill="currentColor" mask="url(#mask-__UID__)"></rect>\n</svg>';

  var SVGMaskUniqueId = 0;

  var createImageOverlayView = function createImageOverlayView(fpAPI) {
    return fpAPI.utils.createView({
      name: 'image-preview-overlay',
      tag: 'div',
      ignoreRect: true,
      create: function create(_ref) {
        var root = _ref.root,
          props = _ref.props;
        var mask = SVG_MASK;
        if (document.querySelector('base')) {
          var url = window.location.href.replace(window.location.hash, '');
          mask = mask.replace(/url\(\#/g, 'url(' + url + '#');
        }

        SVGMaskUniqueId++;
        root.element.classList.add(
          'filepond--image-preview-overlay-'.concat(props.status)
        );

        root.element.innerHTML = mask.replace(/__UID__/g, SVGMaskUniqueId);
      },
      mixins: {
        styles: ['opacity'],
        animations: {
          opacity: { type: 'spring', mass: 25 }
        }
      }
    });
  };

  /**
   * Bitmap Worker
   */
  var BitmapWorker = function BitmapWorker() {
    self.onmessage = function(e) {
      createImageBitmap(e.data.message.file).then(function(bitmap) {
        self.postMessage({ id: e.data.id, message: bitmap }, [bitmap]);
      });
    };
  };

  /**
   * ColorMatrix Worker
   */
  var ColorMatrixWorker = function ColorMatrixWorker() {
    self.onmessage = function(e) {
      var imageData = e.data.message.imageData;
      var matrix = e.data.message.colorMatrix;

      var data = imageData.data;
      var l = data.length;

      var m11 = matrix[0];
      var m12 = matrix[1];
      var m13 = matrix[2];
      var m14 = matrix[3];
      var m15 = matrix[4];

      var m21 = matrix[5];
      var m22 = matrix[6];
      var m23 = matrix[7];
      var m24 = matrix[8];
      var m25 = matrix[9];

      var m31 = matrix[10];
      var m32 = matrix[11];
      var m33 = matrix[12];
      var m34 = matrix[13];
      var m35 = matrix[14];

      var m41 = matrix[15];
      var m42 = matrix[16];
      var m43 = matrix[17];
      var m44 = matrix[18];
      var m45 = matrix[19];

      var index = 0,
        r = 0.0,
        g = 0.0,
        b = 0.0,
        a = 0.0;

      for (; index < l; index += 4) {
        r = data[index] / 255;
        g = data[index + 1] / 255;
        b = data[index + 2] / 255;
        a = data[index + 3] / 255;
        data[index] = Math.max(
          0,
          Math.min((r * m11 + g * m12 + b * m13 + a * m14 + m15) * 255, 255)
        );
        data[index + 1] = Math.max(
          0,
          Math.min((r * m21 + g * m22 + b * m23 + a * m24 + m25) * 255, 255)
        );
        data[index + 2] = Math.max(
          0,
          Math.min((r * m31 + g * m32 + b * m33 + a * m34 + m35) * 255, 255)
        );
        data[index + 3] = Math.max(
          0,
          Math.min((r * m41 + g * m42 + b * m43 + a * m44 + m45) * 255, 255)
        );
      }

      self.postMessage({ id: e.data.id, message: imageData }, [
        imageData.data.buffer
      ]);
    };
  };

  var getImageSize = function getImageSize(url, cb) {
    var image = new Image();
    image.onload = function() {
      var width = image.naturalWidth;
      var height = image.naturalHeight;
      image = null;
      cb(width, height);
    };
    image.src = url;
  };

  var transforms = {
    1: function _() {
      return [1, 0, 0, 1, 0, 0];
    },
    2: function _(width) {
      return [-1, 0, 0, 1, width, 0];
    },
    3: function _(width, height) {
      return [-1, 0, 0, -1, width, height];
    },
    4: function _(width, height) {
      return [1, 0, 0, -1, 0, height];
    },
    5: function _() {
      return [0, 1, 1, 0, 0, 0];
    },
    6: function _(width, height) {
      return [0, 1, -1, 0, height, 0];
    },
    7: function _(width, height) {
      return [0, -1, -1, 0, height, width];
    },
    8: function _(width) {
      return [0, -1, 1, 0, 0, width];
    }
  };

  var fixImageOrientation = function fixImageOrientation(
    ctx,
    width,
    height,
    orientation
  ) {
    // no orientation supplied
    if (orientation === -1) {
      return;
    }

    ctx.transform.apply(ctx, transforms[orientation](width, height));
  };

  // draws the preview image to canvas
  var createPreviewImage = function createPreviewImage(
    data,
    width,
    height,
    orientation
  ) {
    // can't draw on half pixels
    width = Math.round(width);
    height = Math.round(height);

    // draw image
    var canvas = document.createElement('canvas');
    canvas.width = width;
    canvas.height = height;
    var ctx = canvas.getContext('2d');

    // if is rotated incorrectly swap width and height
    if (orientation >= 5 && orientation <= 8) {
      var _ref = [height, width];
      width = _ref[0];
      height = _ref[1];
    }

    // correct image orientation
    fixImageOrientation(ctx, width, height, orientation);

    // draw the image
    ctx.drawImage(data, 0, 0, width, height);

    return canvas;
  };

  var isBitmap = function isBitmap(file) {
    return /^image/.test(file.type) && !/svg/.test(file.type);
  };

  var MAX_WIDTH = 10;
  var MAX_HEIGHT = 10;

  var calculateAverageColor = function calculateAverageColor(image) {
    var scalar = Math.min(MAX_WIDTH / image.width, MAX_HEIGHT / image.height);

    var canvas = document.createElement('canvas');
    var ctx = canvas.getContext('2d');
    var width = (canvas.width = Math.ceil(image.width * scalar));
    var height = (canvas.height = Math.ceil(image.height * scalar));
    ctx.drawImage(image, 0, 0, width, height);
    var data = null;
    try {
      data = ctx.getImageData(0, 0, width, height).data;
    } catch (e) {
      return null;
    }
    var l = data.length;

    var r = 0;
    var g = 0;
    var b = 0;
    var i = 0;

    for (; i < l; i += 4) {
      r += data[i] * data[i];
      g += data[i + 1] * data[i + 1];
      b += data[i + 2] * data[i + 2];
    }

    r = averageColor(r, l);
    g = averageColor(g, l);
    b = averageColor(b, l);

    return { r: r, g: g, b: b };
  };

  var averageColor = function averageColor(c, l) {
    return Math.floor(Math.sqrt(c / (l / 4)));
  };

  var cloneCanvas = function cloneCanvas(origin, target) {
    target = target || document.createElement('canvas');
    target.width = origin.width;
    target.height = origin.height;
    var ctx = target.getContext('2d');
    ctx.drawImage(origin, 0, 0);
    return target;
  };

  var cloneImageData = function cloneImageData(imageData) {
    var id;
    try {
      id = new ImageData(imageData.width, imageData.height);
    } catch (e) {
      var canvas = document.createElement('canvas');
      var ctx = canvas.getContext('2d');
      id = ctx.createImageData(imageData.width, imageData.height);
    }
    id.data.set(new Uint8ClampedArray(imageData.data));
    return id;
  };

  var loadImage = function loadImage(url) {
    return new Promise(function(resolve, reject) {
      var img = new Image();
      img.crossOrigin = 'Anonymous';
      img.onload = function() {
        resolve(img);
      };
      img.onerror = function(e) {
        reject(e);
      };
      img.src = url;
    });
  };

  var createImageWrapperView = function createImageWrapperView(_) {
    // create overlay view
    var OverlayView = createImageOverlayView(_);

    var ImageView = createImageView(_);
    var createWorker = _.utils.createWorker;

    var applyFilter = function applyFilter(root, filter, target) {
      return new Promise(function(resolve) {
        // will store image data for future filter updates
        if (!root.ref.imageData) {
          root.ref.imageData = target
            .getContext('2d')
            .getImageData(0, 0, target.width, target.height);
        }

        // get image data reference
        var imageData = cloneImageData(root.ref.imageData);

        if (!filter || filter.length !== 20) {
          target.getContext('2d').putImageData(imageData, 0, 0);
          return resolve();
        }

        var worker = createWorker(ColorMatrixWorker);
        worker.post(
          {
            imageData: imageData,
            colorMatrix: filter
          },

          function(response) {
            // apply filtered colors
            target.getContext('2d').putImageData(response, 0, 0);

            // stop worker
            worker.terminate();

            // done!
            resolve();
          },
          [imageData.data.buffer]
        );
      });
    };

    var removeImageView = function removeImageView(root, imageView) {
      root.removeChildView(imageView);
      imageView.image.width = 1;
      imageView.image.height = 1;
      imageView._destroy();
    };

    // remove an image
    var shiftImage = function shiftImage(_ref) {
      var root = _ref.root;
      var imageView = root.ref.images.shift();
      imageView.opacity = 0;
      imageView.translateY = -15;
      root.ref.imageViewBin.push(imageView);
      return imageView;
    };

    // add new image
    var pushImage = function pushImage(_ref2) {
      var root = _ref2.root,
        props = _ref2.props,
        image = _ref2.image;
      var id = props.id;
      var item = root.query('GET_ITEM', { id: id });
      if (!item) return;

      var crop = item.getMetadata('crop') || {
        center: {
          x: 0.5,
          y: 0.5
        },

        flip: {
          horizontal: false,
          vertical: false
        },

        zoom: 1,
        rotation: 0,
        aspectRatio: null
      };

      var background = root.query(
        'GET_IMAGE_TRANSFORM_CANVAS_BACKGROUND_COLOR'
      );

      var markup;
      var resize;
      var dirty = false;
      if (root.query('GET_IMAGE_PREVIEW_MARKUP_SHOW')) {
        markup = item.getMetadata('markup') || [];
        resize = item.getMetadata('resize');
        dirty = true;
      }

      // append image presenter
      var imageView = root.appendChildView(
        root.createChildView(ImageView, {
          id: id,
          image: image,
          crop: crop,
          resize: resize,
          markup: markup,
          dirty: dirty,
          background: background,
          opacity: 0,
          scaleX: 1.15,
          scaleY: 1.15,
          translateY: 15
        }),

        root.childViews.length
      );

      root.ref.images.push(imageView);

      // reveal the preview image
      imageView.opacity = 1;
      imageView.scaleX = 1;
      imageView.scaleY = 1;
      imageView.translateY = 0;

      // the preview is now ready to be drawn
      setTimeout(function() {
        root.dispatch('DID_IMAGE_PREVIEW_SHOW', { id: id });
      }, 250);
    };

    var updateImage = function updateImage(_ref3) {
      var root = _ref3.root,
        props = _ref3.props;
      var item = root.query('GET_ITEM', { id: props.id });
      if (!item) return;
      var imageView = root.ref.images[root.ref.images.length - 1];
      imageView.crop = item.getMetadata('crop');
      imageView.background = root.query(
        'GET_IMAGE_TRANSFORM_CANVAS_BACKGROUND_COLOR'
      );

      if (root.query('GET_IMAGE_PREVIEW_MARKUP_SHOW')) {
        imageView.dirty = true;
        imageView.resize = item.getMetadata('resize');
        imageView.markup = item.getMetadata('markup');
      }
    };

    // replace image preview
    var didUpdateItemMetadata = function didUpdateItemMetadata(_ref4) {
      var root = _ref4.root,
        props = _ref4.props,
        action = _ref4.action;
      // only filter and crop trigger redraw
      if (!/crop|filter|markup|resize/.test(action.change.key)) return;

      // no images to update, exit
      if (!root.ref.images.length) return;

      // no item found, exit
      var item = root.query('GET_ITEM', { id: props.id });
      if (!item) return;

      // for now, update existing image when filtering
      if (/filter/.test(action.change.key)) {
        var imageView = root.ref.images[root.ref.images.length - 1];
        applyFilter(root, action.change.value, imageView.image);
        return;
      }

      if (/crop|markup|resize/.test(action.change.key)) {
        var crop = item.getMetadata('crop');
        var image = root.ref.images[root.ref.images.length - 1];

        // if aspect ratio has changed, we need to create a new image
        if (
          crop &&
          crop.aspectRatio &&
          image.crop &&
          image.crop.aspectRatio &&
          Math.abs(crop.aspectRatio - image.crop.aspectRatio) > 0.00001
        ) {
          var _imageView = shiftImage({ root: root });
          pushImage({
            root: root,
            props: props,
            image: cloneCanvas(_imageView.image)
          });
        }
        // if not, we can update the current image
        else {
          updateImage({ root: root, props: props });
        }
      }
    };

    var canCreateImageBitmap = function canCreateImageBitmap(file) {
      // Firefox versions before 58 will freeze when running createImageBitmap
      // in a Web Worker so we detect those versions and return false for support
      var userAgent = window.navigator.userAgent;
      var isFirefox = userAgent.match(/Firefox\/([0-9]+)\./);
      var firefoxVersion = isFirefox ? parseInt(isFirefox[1]) : null;
      if (firefoxVersion <= 58) return false;

      return 'createImageBitmap' in window && isBitmap(file);
    };

    /**
     * Write handler for when preview container has been created
     */
    var didCreatePreviewContainer = function didCreatePreviewContainer(_ref5) {
      var root = _ref5.root,
        props = _ref5.props;
      var id = props.id;

      // we need to get the file data to determine the eventual image size
      var item = root.query('GET_ITEM', id);
      if (!item) return;

      // get url to file (we'll revoke it later on when done)
      var fileURL = URL.createObjectURL(item.file);

      // determine image size of this item
      getImageSize(fileURL, function(width, height) {
        // we can now scale the panel to the final size
        root.dispatch('DID_IMAGE_PREVIEW_CALCULATE_SIZE', {
          id: id,
          width: width,
          height: height
        });
      });
    };

    var drawPreview = function drawPreview(_ref6) {
      var root = _ref6.root,
        props = _ref6.props;
      var id = props.id;

      // we need to get the file data to determine the eventual image size
      var item = root.query('GET_ITEM', id);
      if (!item) return;

      // get url to file (we'll revoke it later on when done)
      var fileURL = URL.createObjectURL(item.file);

      // fallback
      var loadPreviewFallback = function loadPreviewFallback() {
        // let's scale the image in the main thread :(
        loadImage(fileURL).then(previewImageLoaded);
      };

      // image is now ready
      var previewImageLoaded = function previewImageLoaded(imageData) {
        // the file url is no longer needed
        URL.revokeObjectURL(fileURL);

        // draw the scaled down version here and use that as source so bitmapdata can be closed
        // orientation info
        var exif = item.getMetadata('exif') || {};
        var orientation = exif.orientation || -1;

        // get width and height from action, and swap if orientation is incorrect
        var width = imageData.width,
          height = imageData.height;

        // if no width or height, just return early.
        if (!width || !height) return;

        if (orientation >= 5 && orientation <= 8) {
          var _ref7 = [height, width];
          width = _ref7[0];
          height = _ref7[1];
        }

        // scale canvas based on pixel density
        // we multiply by .75 as that creates smaller but still clear images on screens with high res displays
        var pixelDensityFactor = Math.max(1, window.devicePixelRatio * 0.75);

        // we want as much pixels to work with as possible,
        // this multiplies the minimum image resolution,
        // so when zooming in it doesn't get too blurry
        var zoomFactor = root.query('GET_IMAGE_PREVIEW_ZOOM_FACTOR');

        // imaeg scale factor
        var scaleFactor = zoomFactor * pixelDensityFactor;

        // calculate scaled preview image size
        var previewImageRatio = height / width;

        // calculate image preview height and width
        var previewContainerWidth = root.rect.element.width;
        var previewContainerHeight = root.rect.element.height;

        var imageWidth = previewContainerWidth;
        var imageHeight = imageWidth * previewImageRatio;

        if (previewImageRatio > 1) {
          imageWidth = Math.min(width, previewContainerWidth * scaleFactor);
          imageHeight = imageWidth * previewImageRatio;
        } else {
          imageHeight = Math.min(height, previewContainerHeight * scaleFactor);
          imageWidth = imageHeight / previewImageRatio;
        }

        // transfer to image tag so no canvas memory wasted on iOS
        var previewImage = createPreviewImage(
          imageData,
          imageWidth,
          imageHeight,
          orientation
        );

        // done
        var done = function done() {
          // calculate average image color, disabled for now
          var averageColor = root.query(
            'GET_IMAGE_PREVIEW_CALCULATE_AVERAGE_IMAGE_COLOR'
          )
            ? calculateAverageColor(data)
            : null;
          item.setMetadata('color', averageColor, true);

          // data has been transferred to canvas ( if was ImageBitmap )
          if ('close' in imageData) {
            imageData.close();
          }

          // show the overlay
          root.ref.overlayShadow.opacity = 1;

          // create the first image
          pushImage({ root: root, props: props, image: previewImage });
        };

        // apply filter
        var filter = item.getMetadata('filter');
        if (filter) {
          applyFilter(root, filter, previewImage).then(done);
        } else {
          done();
        }
      };

      // if we support scaling using createImageBitmap we use a worker
      if (canCreateImageBitmap(item.file)) {
        // let's scale the image in a worker
        var worker = createWorker(BitmapWorker);

        worker.post(
          {
            file: item.file
          },

          function(imageBitmap) {
            // destroy worker
            worker.terminate();

            // no bitmap returned, must be something wrong,
            // try the oldschool way
            if (!imageBitmap) {
              loadPreviewFallback();
              return;
            }

            // yay we got our bitmap, let's continue showing the preview
            previewImageLoaded(imageBitmap);
          }
        );
      } else {
        // create fallback preview
        loadPreviewFallback();
      }
    };

    /**
     * Write handler for when the preview image is ready to be animated
     */
    var didDrawPreview = function didDrawPreview(_ref8) {
      var root = _ref8.root;
      // get last added image
      var image = root.ref.images[root.ref.images.length - 1];
      image.translateY = 0;
      image.scaleX = 1.0;
      image.scaleY = 1.0;
      image.opacity = 1;
    };

    /**
     * Write handler for when the preview has been loaded
     */
    var restoreOverlay = function restoreOverlay(_ref9) {
      var root = _ref9.root;
      root.ref.overlayShadow.opacity = 1;
      root.ref.overlayError.opacity = 0;
      root.ref.overlaySuccess.opacity = 0;
    };

    var didThrowError = function didThrowError(_ref10) {
      var root = _ref10.root;
      root.ref.overlayShadow.opacity = 0.25;
      root.ref.overlayError.opacity = 1;
    };

    var didCompleteProcessing = function didCompleteProcessing(_ref11) {
      var root = _ref11.root;
      root.ref.overlayShadow.opacity = 0.25;
      root.ref.overlaySuccess.opacity = 1;
    };

    /**
     * Constructor
     */
    var create = function create(_ref12) {
      var root = _ref12.root;
      // image view
      root.ref.images = [];

      // the preview image data (we need this to filter the image)
      root.ref.imageData = null;

      // image bin
      root.ref.imageViewBin = [];

      // image overlays
      root.ref.overlayShadow = root.appendChildView(
        root.createChildView(OverlayView, {
          opacity: 0,
          status: 'idle'
        })
      );

      root.ref.overlaySuccess = root.appendChildView(
        root.createChildView(OverlayView, {
          opacity: 0,
          status: 'success'
        })
      );

      root.ref.overlayError = root.appendChildView(
        root.createChildView(OverlayView, {
          opacity: 0,
          status: 'failure'
        })
      );
    };

    return _.utils.createView({
      name: 'image-preview-wrapper',
      create: create,
      styles: ['height'],
      apis: ['height'],
      destroy: function destroy(_ref13) {
        var root = _ref13.root;
        // we resize the image so memory on iOS 12 is released more quickly (it seems)
        root.ref.images.forEach(function(imageView) {
          imageView.image.width = 1;
          imageView.image.height = 1;
        });
      },
      didWriteView: function didWriteView(_ref14) {
        var root = _ref14.root;
        root.ref.images.forEach(function(imageView) {
          imageView.dirty = false;
        });
      },
      write: _.utils.createRoute(
        {
          // image preview stated
          DID_IMAGE_PREVIEW_DRAW: didDrawPreview,
          DID_IMAGE_PREVIEW_CONTAINER_CREATE: didCreatePreviewContainer,
          DID_FINISH_CALCULATE_PREVIEWSIZE: drawPreview,
          DID_UPDATE_ITEM_METADATA: didUpdateItemMetadata,

          // file states
          DID_THROW_ITEM_LOAD_ERROR: didThrowError,
          DID_THROW_ITEM_PROCESSING_ERROR: didThrowError,
          DID_THROW_ITEM_INVALID: didThrowError,
          DID_COMPLETE_ITEM_PROCESSING: didCompleteProcessing,
          DID_START_ITEM_PROCESSING: restoreOverlay,
          DID_REVERT_ITEM_PROCESSING: restoreOverlay
        },

        function(_ref15) {
          var root = _ref15.root;
          // views on death row
          var viewsToRemove = root.ref.imageViewBin.filter(function(imageView) {
            return imageView.opacity === 0;
          });

          // views to retain
          root.ref.imageViewBin = root.ref.imageViewBin.filter(function(
            imageView
          ) {
            return imageView.opacity > 0;
          });

          // remove these views
          viewsToRemove.forEach(function(imageView) {
            return removeImageView(root, imageView);
          });
          viewsToRemove.length = 0;
        }
      )
    });
  };

  /**
   * Image Preview Plugin
   */
  var plugin = function plugin(fpAPI) {
    var addFilter = fpAPI.addFilter,
      utils = fpAPI.utils;
    var Type = utils.Type,
      createRoute = utils.createRoute,
      isFile = utils.isFile;

    // imagePreviewView
    var imagePreviewView = createImageWrapperView(fpAPI);

    // called for each view that is created right after the 'create' method
    addFilter('CREATE_VIEW', function(viewAPI) {
      // get reference to created view
      var is = viewAPI.is,
        view = viewAPI.view,
        query = viewAPI.query;

      // only hook up to item view and only if is enabled for this cropper
      if (!is('file') || !query('GET_ALLOW_IMAGE_PREVIEW')) return;

      // create the image preview plugin, but only do so if the item is an image
      var didLoadItem = function didLoadItem(_ref) {
        var root = _ref.root,
          props = _ref.props;
        var id = props.id;
        var item = query('GET_ITEM', id);

        // item could theoretically have been removed in the mean time
        if (!item || !isFile(item.file) || item.archived) return;

        // get the file object
        var file = item.file;

        // exit if this is not an image
        if (!isPreviewableImage(file)) return;

        // test if is filtered
        if (!query('GET_IMAGE_PREVIEW_FILTER_ITEM')(item)) return;

        // exit if image size is too high and no createImageBitmap support
        // this would simply bring the browser to its knees and that is not what we want
        var supportsCreateImageBitmap = 'createImageBitmap' in (window || {});
        var maxPreviewFileSize = query('GET_IMAGE_PREVIEW_MAX_FILE_SIZE');
        if (
          !supportsCreateImageBitmap &&
          maxPreviewFileSize &&
          file.size > maxPreviewFileSize
        )
          return;

        // set preview view
        root.ref.imagePreview = view.appendChildView(
          view.createChildView(imagePreviewView, { id: id })
        );

        // update height if is fixed
        var fixedPreviewHeight = root.query('GET_IMAGE_PREVIEW_HEIGHT');
        if (fixedPreviewHeight) {
          root.dispatch('DID_UPDATE_PANEL_HEIGHT', {
            id: item.id,
            height: fixedPreviewHeight
          });
        }

        // now ready
        var queue =
          !supportsCreateImageBitmap &&
          file.size > query('GET_IMAGE_PREVIEW_MAX_INSTANT_PREVIEW_FILE_SIZE');
        root.dispatch('DID_IMAGE_PREVIEW_CONTAINER_CREATE', { id: id }, queue);
      };

      var rescaleItem = function rescaleItem(root, props) {
        if (!root.ref.imagePreview) return;
        var id = props.id;

        // get item
        var item = root.query('GET_ITEM', { id: id });
        if (!item) return;

        // if is fixed height or panel has aspect ratio, exit here, height has already been defined
        var panelAspectRatio = root.query('GET_PANEL_ASPECT_RATIO');
        var itemPanelAspectRatio = root.query('GET_ITEM_PANEL_ASPECT_RATIO');
        var fixedHeight = root.query('GET_IMAGE_PREVIEW_HEIGHT');
        if (panelAspectRatio || itemPanelAspectRatio || fixedHeight) return;

        // no data!
        var _root$ref = root.ref,
          imageWidth = _root$ref.imageWidth,
          imageHeight = _root$ref.imageHeight;
        if (!imageWidth || !imageHeight) return;

        // get height min and max
        var minPreviewHeight = root.query('GET_IMAGE_PREVIEW_MIN_HEIGHT');
        var maxPreviewHeight = root.query('GET_IMAGE_PREVIEW_MAX_HEIGHT');

        // orientation info
        var exif = item.getMetadata('exif') || {};
        var orientation = exif.orientation || -1;

        // get width and height from action, and swap of orientation is incorrect
        if (orientation >= 5 && orientation <= 8) {
          var _ref2 = [imageHeight, imageWidth];
          imageWidth = _ref2[0];
          imageHeight = _ref2[1];
        }

        // scale up width and height when we're dealing with an SVG
        if (!isBitmap(item.file) || root.query('GET_IMAGE_PREVIEW_UPSCALE')) {
          var scalar = 2048 / imageWidth;
          imageWidth *= scalar;
          imageHeight *= scalar;
        }

        // image aspect ratio
        var imageAspectRatio = imageHeight / imageWidth;

        // we need the item to get to the crop size
        var previewAspectRatio =
          (item.getMetadata('crop') || {}).aspectRatio || imageAspectRatio;

        // preview height range
        var previewHeightMax = Math.max(
          minPreviewHeight,
          Math.min(imageHeight, maxPreviewHeight)
        );

        var itemWidth = root.rect.element.width;
        var previewHeight = Math.min(
          itemWidth * previewAspectRatio,
          previewHeightMax
        );

        // request update to panel height
        root.dispatch('DID_UPDATE_PANEL_HEIGHT', {
          id: item.id,
          height: previewHeight
        });
      };

      var didResizeView = function didResizeView(_ref3) {
        var root = _ref3.root;
        // actions in next write operation
        root.ref.shouldRescale = true;
      };

      var didUpdateItemMetadata = function didUpdateItemMetadata(_ref4) {
        var root = _ref4.root,
          action = _ref4.action;
        if (action.change.key !== 'crop') return;

        // actions in next write operation
        root.ref.shouldRescale = true;
      };

      var didCalculatePreviewSize = function didCalculatePreviewSize(_ref5) {
        var root = _ref5.root,
          action = _ref5.action;
        // remember dimensions
        root.ref.imageWidth = action.width;
        root.ref.imageHeight = action.height;

        // actions in next write operation
        root.ref.shouldRescale = true;
        root.ref.shouldDrawPreview = true;

        // as image load could take a while and fire when draw loop is resting we need to give it a kick
        root.dispatch('KICK');
      };

      // start writing
      view.registerWriter(
        createRoute(
          {
            DID_RESIZE_ROOT: didResizeView,
            DID_STOP_RESIZE: didResizeView,
            DID_LOAD_ITEM: didLoadItem,
            DID_IMAGE_PREVIEW_CALCULATE_SIZE: didCalculatePreviewSize,
            DID_UPDATE_ITEM_METADATA: didUpdateItemMetadata
          },

          function(_ref6) {
            var root = _ref6.root,
              props = _ref6.props;
            // no preview view attached
            if (!root.ref.imagePreview) return;

            // don't do anything while hidden
            if (root.rect.element.hidden) return;

            // resize the item panel
            if (root.ref.shouldRescale) {
              rescaleItem(root, props);
              root.ref.shouldRescale = false;
            }

            if (root.ref.shouldDrawPreview) {
              // queue till next frame so we're sure the height has been applied this forces the draw image call inside the wrapper view to use the correct height
              requestAnimationFrame(function() {
                // this requestAnimationFrame nesting is horrible but it fixes an issue with 100hz displays on Chrome
                // https://github.com/pqina/filepond-plugin-image-preview/issues/57
                requestAnimationFrame(function() {
                  root.dispatch('DID_FINISH_CALCULATE_PREVIEWSIZE', {
                    id: props.id
                  });
                });
              });

              root.ref.shouldDrawPreview = false;
            }
          }
        )
      );
    });

    // expose plugin
    return {
      options: {
        // Enable or disable image preview
        allowImagePreview: [true, Type.BOOLEAN],

        // filters file items to determine which are shown as preview
        imagePreviewFilterItem: [
          function() {
            return true;
          },
          Type.FUNCTION
        ],

        // Fixed preview height
        imagePreviewHeight: [null, Type.INT],

        // Min image height
        imagePreviewMinHeight: [44, Type.INT],

        // Max image height
        imagePreviewMaxHeight: [256, Type.INT],

        // Max size of preview file for when createImageBitmap is not supported
        imagePreviewMaxFileSize: [null, Type.INT],

        // The amount of extra pixels added to the image preview to allow comfortable zooming
        imagePreviewZoomFactor: [2, Type.INT],

        // Should we upscale small images to fit the max bounding box of the preview area
        imagePreviewUpscale: [false, Type.BOOLEAN],

        // Max size of preview file that we allow to try to instant preview if createImageBitmap is not supported, else image is queued for loading
        imagePreviewMaxInstantPreviewFileSize: [1000000, Type.INT],

        // Style of the transparancy indicator used behind images
        imagePreviewTransparencyIndicator: [null, Type.STRING],

        // Enables or disables reading average image color
        imagePreviewCalculateAverageImageColor: [false, Type.BOOLEAN],

        // Enables or disables the previewing of markup
        imagePreviewMarkupShow: [true, Type.BOOLEAN],

        // Allows filtering of markup to only show certain shapes
        imagePreviewMarkupFilter: [
          function() {
            return true;
          },
          Type.FUNCTION
        ]
      }
    };
  };

  // fire pluginloaded event if running in browser, this allows registering the plugin when using async script tags
  var isBrowser =
    typeof window !== 'undefined' && typeof window.document !== 'undefined';
  if (isBrowser) {
    document.dispatchEvent(
      new CustomEvent('FilePond:pluginloaded', { detail: plugin })
    );
  }

  return plugin;
});

/*!
 * FilePondPluginImageResize 2.0.10
 * Licensed under MIT, https://opensource.org/licenses/MIT/
 * Please visit https://pqina.nl/filepond/ for details.
 */

/* eslint-disable */

(function(global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined'
        ? (module.exports = factory())
        : typeof define === 'function' && define.amd
        ? define(factory)
        : ((global = global || self), (global.FilePondPluginImageResize = factory()));
})(this, function() {
    'use strict';

    // test if file is of type image
    var isImage = function isImage(file) {
        return /^image/.test(file.type);
    };

    var getImageSize = function getImageSize(url, cb) {
        var image = new Image();
        image.onload = function() {
            var width = image.naturalWidth;
            var height = image.naturalHeight;
            image = null;
            cb({ width: width, height: height });
        };
        image.onerror = function() {
            return cb(null);
        };
        image.src = url;
    };

    /**
     * Image Auto Resize Plugin
     */
    var plugin = function plugin(_ref) {
        var addFilter = _ref.addFilter,
            utils = _ref.utils;
        var Type = utils.Type;

        // subscribe to file load and append required transformations
        addFilter('DID_LOAD_ITEM', function(item, _ref2) {
            var query = _ref2.query;
            return new Promise(function(resolve, reject) {
                // get file reference
                var file = item.file;

                // if this is not an image we do not have any business cropping it
                if (!isImage(file) || !query('GET_ALLOW_IMAGE_RESIZE')) {
                    // continue with the unaltered dataset
                    return resolve(item);
                }

                var mode = query('GET_IMAGE_RESIZE_MODE');
                var width = query('GET_IMAGE_RESIZE_TARGET_WIDTH');
                var height = query('GET_IMAGE_RESIZE_TARGET_HEIGHT');
                var upscale = query('GET_IMAGE_RESIZE_UPSCALE');

                // no resizing to be done
                if (width === null && height === null) return resolve(item);

                var targetWidth = width === null ? height : width;
                var targetHeight = height === null ? targetWidth : height;

                // if should not upscale, we need to determine the size of the file
                var fileURL = URL.createObjectURL(file);
                getImageSize(fileURL, function(size) {
                    URL.revokeObjectURL(fileURL);

                    // something went wrong
                    if (!size) return resolve(item);
                    var imageWidth = size.width,
                        imageHeight = size.height;

                    // get exif orientation
                    var orientation = (item.getMetadata('exif') || {}).orientation || -1;

                    // swap width and height if orientation needs correcting
                    if (orientation >= 5 && orientation <= 8) {
                        var _ref3 = [imageHeight, imageWidth];
                        imageWidth = _ref3[0];
                        imageHeight = _ref3[1];
                    }

                    // image is already perfect size, no transformations required
                    if (imageWidth === targetWidth && imageHeight === targetHeight)
                        return resolve(item);

                    // already contained?
                    // can't upscale image, so if already at correct scale, exit
                    if (!upscale) {
                        // covering target size
                        if (mode === 'cover') {
                            // if one of edges is smaller than target size, exit
                            if (imageWidth <= targetWidth || imageHeight <= targetHeight)
                                return resolve(item);
                        }

                        // not covering target size, if image is contained in target size, exit
                        else if (imageWidth <= targetWidth && imageHeight <= targetWidth) {
                            return resolve(item);
                        }
                    }

                    // the image needs to be resized
                    item.setMetadata('resize', {
                        mode: mode,
                        upscale: upscale,
                        size: {
                            width: targetWidth,
                            height: targetHeight,
                        },
                    });

                    resolve(item);
                });
            });
        });

        // Expose plugin options
        return {
            options: {
                // Enable or disable image resizing
                allowImageResize: [true, Type.BOOLEAN],

                // the method of rescaling
                // - force => force set size
                // - cover => pick biggest dimension
                // - contain => pick smaller dimension
                imageResizeMode: ['cover', Type.STRING],

                // set to false to disable upscaling of image smaller than the target width / height
                imageResizeUpscale: [true, Type.BOOLEAN],

                // target width
                imageResizeTargetWidth: [null, Type.INT],

                // target height
                imageResizeTargetHeight: [null, Type.INT],
            },
        };
    };

    // fire pluginloaded event if running in browser, this allows registering the plugin when using async script tags
    var isBrowser = typeof window !== 'undefined' && typeof window.document !== 'undefined';
    if (isBrowser) {
        document.dispatchEvent(new CustomEvent('FilePond:pluginloaded', { detail: plugin }));
    }

    return plugin;
});

/*!
 * FilePondPluginImageTransform 3.8.7
 * Licensed under MIT, https://opensource.org/licenses/MIT/
 * Please visit https://pqina.nl/filepond/ for details.
 */

/* eslint-disable */

(function(global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined'
        ? (module.exports = factory())
        : typeof define === 'function' && define.amd
        ? define(factory)
        : ((global = global || self), (global.FilePondPluginImageTransform = factory()));
})(this, function() {
    'use strict';

    // test if file is of type image
    var isImage = function isImage(file) {
        return /^image/.test(file.type);
    };

    var getFilenameWithoutExtension = function getFilenameWithoutExtension(name) {
        return name.substr(0, name.lastIndexOf('.')) || name;
    };

    // only handles image/jpg, image/jpeg, image/png, and image/svg+xml for now
    var ExtensionMap = {
        jpeg: 'jpg',
        'svg+xml': 'svg',
    };

    var renameFileToMatchMimeType = function renameFileToMatchMimeType(filename, mimeType) {
        var name = getFilenameWithoutExtension(filename);
        var type = mimeType.split('/')[1];
        var extension = ExtensionMap[type] || type;
        return ''.concat(name, '.').concat(extension);
    };

    // returns all the valid output formats we can encode towards
    var getValidOutputMimeType = function getValidOutputMimeType(type) {
        return /jpeg|png|svg\+xml/.test(type) ? type : 'image/jpeg';
    };

    // test if file is of type image
    var isImage$1 = function isImage(file) {
        return /^image/.test(file.type);
    };

    var MATRICES = {
        1: function _() {
            return [1, 0, 0, 1, 0, 0];
        },
        2: function _(width) {
            return [-1, 0, 0, 1, width, 0];
        },
        3: function _(width, height) {
            return [-1, 0, 0, -1, width, height];
        },
        4: function _(width, height) {
            return [1, 0, 0, -1, 0, height];
        },
        5: function _() {
            return [0, 1, 1, 0, 0, 0];
        },
        6: function _(width, height) {
            return [0, 1, -1, 0, height, 0];
        },
        7: function _(width, height) {
            return [0, -1, -1, 0, height, width];
        },
        8: function _(width) {
            return [0, -1, 1, 0, 0, width];
        },
    };

    var getImageOrientationMatrix = function getImageOrientationMatrix(width, height, orientation) {
        if (orientation === -1) {
            orientation = 1;
        }
        return MATRICES[orientation](width, height);
    };

    var createVector = function createVector(x, y) {
        return { x: x, y: y };
    };

    var vectorDot = function vectorDot(a, b) {
        return a.x * b.x + a.y * b.y;
    };

    var vectorSubtract = function vectorSubtract(a, b) {
        return createVector(a.x - b.x, a.y - b.y);
    };

    var vectorDistanceSquared = function vectorDistanceSquared(a, b) {
        return vectorDot(vectorSubtract(a, b), vectorSubtract(a, b));
    };

    var vectorDistance = function vectorDistance(a, b) {
        return Math.sqrt(vectorDistanceSquared(a, b));
    };

    var getOffsetPointOnEdge = function getOffsetPointOnEdge(length, rotation) {
        var a = length;

        var A = 1.5707963267948966;
        var B = rotation;
        var C = 1.5707963267948966 - rotation;

        var sinA = Math.sin(A);
        var sinB = Math.sin(B);
        var sinC = Math.sin(C);
        var cosC = Math.cos(C);
        var ratio = a / sinA;
        var b = ratio * sinB;
        var c = ratio * sinC;

        return createVector(cosC * b, cosC * c);
    };

    var getRotatedRectSize = function getRotatedRectSize(rect, rotation) {
        var w = rect.width;
        var h = rect.height;

        var hor = getOffsetPointOnEdge(w, rotation);
        var ver = getOffsetPointOnEdge(h, rotation);

        var tl = createVector(rect.x + Math.abs(hor.x), rect.y - Math.abs(hor.y));

        var tr = createVector(rect.x + rect.width + Math.abs(ver.y), rect.y + Math.abs(ver.x));

        var bl = createVector(rect.x - Math.abs(ver.y), rect.y + rect.height - Math.abs(ver.x));

        return {
            width: vectorDistance(tl, tr),
            height: vectorDistance(tl, bl),
        };
    };

    var getImageRectZoomFactor = function getImageRectZoomFactor(imageRect, cropRect) {
        var rotation = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0;
        var center =
            arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : { x: 0.5, y: 0.5 };

        // calculate available space round image center position
        var cx = center.x > 0.5 ? 1 - center.x : center.x;
        var cy = center.y > 0.5 ? 1 - center.y : center.y;
        var imageWidth = cx * 2 * imageRect.width;
        var imageHeight = cy * 2 * imageRect.height;

        // calculate rotated crop rectangle size
        var rotatedCropSize = getRotatedRectSize(cropRect, rotation);

        return Math.max(rotatedCropSize.width / imageWidth, rotatedCropSize.height / imageHeight);
    };

    var getCenteredCropRect = function getCenteredCropRect(container, aspectRatio) {
        var width = container.width;
        var height = width * aspectRatio;
        if (height > container.height) {
            height = container.height;
            width = height / aspectRatio;
        }
        var x = (container.width - width) * 0.5;
        var y = (container.height - height) * 0.5;

        return {
            x: x,
            y: y,
            width: width,
            height: height,
        };
    };

    var calculateCanvasSize = function calculateCanvasSize(image, canvasAspectRatio) {
        var zoom = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 1;

        var imageAspectRatio = image.height / image.width;

        // determine actual pixels on x and y axis
        var canvasWidth = 1;
        var canvasHeight = canvasAspectRatio;
        var imgWidth = 1;
        var imgHeight = imageAspectRatio;
        if (imgHeight > canvasHeight) {
            imgHeight = canvasHeight;
            imgWidth = imgHeight / imageAspectRatio;
        }

        var scalar = Math.max(canvasWidth / imgWidth, canvasHeight / imgHeight);
        var width = image.width / (zoom * scalar * imgWidth);
        var height = width * canvasAspectRatio;

        return {
            width: width,
            height: height,
        };
    };

    var canvasRelease = function canvasRelease(canvas) {
        canvas.width = 1;
        canvas.height = 1;
        var ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, 1, 1);
    };

    var isFlipped = function isFlipped(flip) {
        return flip && (flip.horizontal || flip.vertical);
    };

    var getBitmap = function getBitmap(image, orientation, flip) {
        if (orientation <= 1 && !isFlipped(flip)) {
            image.width = image.naturalWidth;
            image.height = image.naturalHeight;
            return image;
        }

        var canvas = document.createElement('canvas');
        var width = image.naturalWidth;
        var height = image.naturalHeight;

        // if is rotated incorrectly swap width and height
        var swapped = orientation >= 5 && orientation <= 8;
        if (swapped) {
            canvas.width = height;
            canvas.height = width;
        } else {
            canvas.width = width;
            canvas.height = height;
        }

        // draw the image but first fix orientation and set correct flip
        var ctx = canvas.getContext('2d');

        // get base transformation matrix
        if (orientation) {
            ctx.transform.apply(ctx, getImageOrientationMatrix(width, height, orientation));
        }

        if (isFlipped(flip)) {
            // flip horizontal
            // [-1, 0, 0, 1, width, 0]
            var matrix = [1, 0, 0, 1, 0, 0];
            if ((!swapped && flip.horizontal) || swapped & flip.vertical) {
                matrix[0] = -1;
                matrix[4] = width;
            }

            // flip vertical
            // [1, 0, 0, -1, 0, height]
            if ((!swapped && flip.vertical) || (swapped && flip.horizontal)) {
                matrix[3] = -1;
                matrix[5] = height;
            }

            ctx.transform.apply(ctx, matrix);
        }

        ctx.drawImage(image, 0, 0, width, height);

        return canvas;
    };

    var imageToImageData = function imageToImageData(imageElement, orientation) {
        var crop = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
        var options = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : {};
        var canvasMemoryLimit = options.canvasMemoryLimit,
            _options$background = options.background,
            background = _options$background === void 0 ? null : _options$background;

        var zoom = crop.zoom || 1;

        // fixes possible image orientation problems by drawing the image on the correct canvas
        var bitmap = getBitmap(imageElement, orientation, crop.flip);
        var imageSize = {
            width: bitmap.width,
            height: bitmap.height,
        };

        var aspectRatio = crop.aspectRatio || imageSize.height / imageSize.width;

        var canvasSize = calculateCanvasSize(imageSize, aspectRatio, zoom);

        if (canvasMemoryLimit) {
            var requiredMemory = canvasSize.width * canvasSize.height;
            if (requiredMemory > canvasMemoryLimit) {
                var scalar = Math.sqrt(canvasMemoryLimit) / Math.sqrt(requiredMemory);
                imageSize.width = Math.floor(imageSize.width * scalar);
                imageSize.height = Math.floor(imageSize.height * scalar);
                canvasSize = calculateCanvasSize(imageSize, aspectRatio, zoom);
            }
        }

        var canvas = document.createElement('canvas');

        var canvasCenter = {
            x: canvasSize.width * 0.5,
            y: canvasSize.height * 0.5,
        };

        var stage = {
            x: 0,
            y: 0,
            width: canvasSize.width,
            height: canvasSize.height,
            center: canvasCenter,
        };

        var shouldLimit = typeof crop.scaleToFit === 'undefined' || crop.scaleToFit;

        var scale =
            zoom *
            getImageRectZoomFactor(
                imageSize,
                getCenteredCropRect(stage, aspectRatio),
                crop.rotation,
                shouldLimit ? crop.center : { x: 0.5, y: 0.5 }
            );

        // start drawing
        canvas.width = Math.round(canvasSize.width / scale);
        canvas.height = Math.round(canvasSize.height / scale);

        canvasCenter.x /= scale;
        canvasCenter.y /= scale;

        var imageOffset = {
            x: canvasCenter.x - imageSize.width * (crop.center ? crop.center.x : 0.5),
            y: canvasCenter.y - imageSize.height * (crop.center ? crop.center.y : 0.5),
        };

        var ctx = canvas.getContext('2d');
        if (background) {
            ctx.fillStyle = background;
            ctx.fillRect(0, 0, canvas.width, canvas.height);
        }

        // move to draw offset
        ctx.translate(canvasCenter.x, canvasCenter.y);
        ctx.rotate(crop.rotation || 0);

        // draw the image
        ctx.drawImage(
            bitmap,
            imageOffset.x - canvasCenter.x,
            imageOffset.y - canvasCenter.y,
            imageSize.width,
            imageSize.height
        );

        // get data from canvas
        var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);

        // release canvas
        canvasRelease(canvas);

        // return data
        return imageData;
    };

    /**
     * Polyfill toBlob for Edge
     */
    var IS_BROWSER = (function() {
        return typeof window !== 'undefined' && typeof window.document !== 'undefined';
    })();
    if (IS_BROWSER) {
        if (!HTMLCanvasElement.prototype.toBlob) {
            Object.defineProperty(HTMLCanvasElement.prototype, 'toBlob', {
                value: function value(callback, type, quality) {
                    var dataURL = this.toDataURL(type, quality).split(',')[1];
                    setTimeout(function() {
                        var binStr = atob(dataURL);
                        var len = binStr.length;
                        var arr = new Uint8Array(len);
                        for (var i = 0; i < len; i++) {
                            arr[i] = binStr.charCodeAt(i);
                        }
                        callback(new Blob([arr], { type: type || 'image/png' }));
                    });
                },
            });
        }
    }

    var canvasToBlob = function canvasToBlob(canvas, options) {
        var beforeCreateBlob =
            arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
        return new Promise(function(resolve) {
            var promisedImage = beforeCreateBlob ? beforeCreateBlob(canvas) : canvas;
            Promise.resolve(promisedImage).then(function(canvas) {
                canvas.toBlob(resolve, options.type, options.quality);
            });
        });
    };

    var vectorMultiply = function vectorMultiply(v, amount) {
        return createVector$1(v.x * amount, v.y * amount);
    };

    var vectorAdd = function vectorAdd(a, b) {
        return createVector$1(a.x + b.x, a.y + b.y);
    };

    var vectorNormalize = function vectorNormalize(v) {
        var l = Math.sqrt(v.x * v.x + v.y * v.y);
        if (l === 0) {
            return {
                x: 0,
                y: 0,
            };
        }
        return createVector$1(v.x / l, v.y / l);
    };

    var vectorRotate = function vectorRotate(v, radians, origin) {
        var cos = Math.cos(radians);
        var sin = Math.sin(radians);
        var t = createVector$1(v.x - origin.x, v.y - origin.y);
        return createVector$1(origin.x + cos * t.x - sin * t.y, origin.y + sin * t.x + cos * t.y);
    };

    var createVector$1 = function createVector() {
        var x = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
        var y = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
        return { x: x, y: y };
    };

    var getMarkupValue = function getMarkupValue(value, size) {
        var scalar = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 1;
        var axis = arguments.length > 3 ? arguments[3] : undefined;
        if (typeof value === 'string') {
            return parseFloat(value) * scalar;
        }
        if (typeof value === 'number') {
            return value * (axis ? size[axis] : Math.min(size.width, size.height));
        }
        return;
    };

    var getMarkupStyles = function getMarkupStyles(markup, size, scale) {
        var lineStyle = markup.borderStyle || markup.lineStyle || 'solid';
        var fill = markup.backgroundColor || markup.fontColor || 'transparent';
        var stroke = markup.borderColor || markup.lineColor || 'transparent';
        var strokeWidth = getMarkupValue(markup.borderWidth || markup.lineWidth, size, scale);
        var lineCap = markup.lineCap || 'round';
        var lineJoin = markup.lineJoin || 'round';
        var dashes =
            typeof lineStyle === 'string'
                ? ''
                : lineStyle
                      .map(function(v) {
                          return getMarkupValue(v, size, scale);
                      })
                      .join(',');
        var opacity = markup.opacity || 1;
        return {
            'stroke-linecap': lineCap,
            'stroke-linejoin': lineJoin,
            'stroke-width': strokeWidth || 0,
            'stroke-dasharray': dashes,
            stroke: stroke,
            fill: fill,
            opacity: opacity,
        };
    };

    var isDefined = function isDefined(value) {
        return value != null;
    };

    var getMarkupRect = function getMarkupRect(rect, size) {
        var scalar = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 1;

        var left =
            getMarkupValue(rect.x, size, scalar, 'width') ||
            getMarkupValue(rect.left, size, scalar, 'width');
        var top =
            getMarkupValue(rect.y, size, scalar, 'height') ||
            getMarkupValue(rect.top, size, scalar, 'height');
        var width = getMarkupValue(rect.width, size, scalar, 'width');
        var height = getMarkupValue(rect.height, size, scalar, 'height');
        var right = getMarkupValue(rect.right, size, scalar, 'width');
        var bottom = getMarkupValue(rect.bottom, size, scalar, 'height');

        if (!isDefined(top)) {
            if (isDefined(height) && isDefined(bottom)) {
                top = size.height - height - bottom;
            } else {
                top = bottom;
            }
        }

        if (!isDefined(left)) {
            if (isDefined(width) && isDefined(right)) {
                left = size.width - width - right;
            } else {
                left = right;
            }
        }

        if (!isDefined(width)) {
            if (isDefined(left) && isDefined(right)) {
                width = size.width - left - right;
            } else {
                width = 0;
            }
        }

        if (!isDefined(height)) {
            if (isDefined(top) && isDefined(bottom)) {
                height = size.height - top - bottom;
            } else {
                height = 0;
            }
        }

        return {
            x: left || 0,
            y: top || 0,
            width: width || 0,
            height: height || 0,
        };
    };

    var pointsToPathShape = function pointsToPathShape(points) {
        return points
            .map(function(point, index) {
                return ''
                    .concat(index === 0 ? 'M' : 'L', ' ')
                    .concat(point.x, ' ')
                    .concat(point.y);
            })
            .join(' ');
    };

    var setAttributes = function setAttributes(element, attr) {
        return Object.keys(attr).forEach(function(key) {
            return element.setAttribute(key, attr[key]);
        });
    };

    var ns = 'http://www.w3.org/2000/svg';
    var svg = function svg(tag, attr) {
        var element = document.createElementNS(ns, tag);
        if (attr) {
            setAttributes(element, attr);
        }
        return element;
    };

    var updateRect = function updateRect(element) {
        return setAttributes(element, Object.assign({}, element.rect, element.styles));
    };

    var updateEllipse = function updateEllipse(element) {
        var cx = element.rect.x + element.rect.width * 0.5;
        var cy = element.rect.y + element.rect.height * 0.5;
        var rx = element.rect.width * 0.5;
        var ry = element.rect.height * 0.5;
        return setAttributes(
            element,
            Object.assign(
                {
                    cx: cx,
                    cy: cy,
                    rx: rx,
                    ry: ry,
                },
                element.styles
            )
        );
    };

    var IMAGE_FIT_STYLE = {
        contain: 'xMidYMid meet',
        cover: 'xMidYMid slice',
    };

    var updateImage = function updateImage(element, markup) {
        setAttributes(
            element,
            Object.assign({}, element.rect, element.styles, {
                preserveAspectRatio: IMAGE_FIT_STYLE[markup.fit] || 'none',
            })
        );
    };

    var TEXT_ANCHOR = {
        left: 'start',
        center: 'middle',
        right: 'end',
    };

    var updateText = function updateText(element, markup, size, scale) {
        var fontSize = getMarkupValue(markup.fontSize, size, scale);
        var fontFamily = markup.fontFamily || 'sans-serif';
        var fontWeight = markup.fontWeight || 'normal';
        var textAlign = TEXT_ANCHOR[markup.textAlign] || 'start';

        setAttributes(
            element,
            Object.assign({}, element.rect, element.styles, {
                'stroke-width': 0,
                'font-weight': fontWeight,
                'font-size': fontSize,
                'font-family': fontFamily,
                'text-anchor': textAlign,
            })
        );

        // update text
        if (element.text !== markup.text) {
            element.text = markup.text;
            element.textContent = markup.text.length ? markup.text : ' ';
        }
    };

    var updateLine = function updateLine(element, markup, size, scale) {
        setAttributes(
            element,
            Object.assign({}, element.rect, element.styles, {
                fill: 'none',
            })
        );

        var line = element.childNodes[0];
        var begin = element.childNodes[1];
        var end = element.childNodes[2];

        var origin = element.rect;

        var target = {
            x: element.rect.x + element.rect.width,
            y: element.rect.y + element.rect.height,
        };

        setAttributes(line, {
            x1: origin.x,
            y1: origin.y,
            x2: target.x,
            y2: target.y,
        });

        if (!markup.lineDecoration) return;

        begin.style.display = 'none';
        end.style.display = 'none';

        var v = vectorNormalize({
            x: target.x - origin.x,
            y: target.y - origin.y,
        });

        var l = getMarkupValue(0.05, size, scale);

        if (markup.lineDecoration.indexOf('arrow-begin') !== -1) {
            var arrowBeginRotationPoint = vectorMultiply(v, l);
            var arrowBeginCenter = vectorAdd(origin, arrowBeginRotationPoint);
            var arrowBeginA = vectorRotate(origin, 2, arrowBeginCenter);
            var arrowBeginB = vectorRotate(origin, -2, arrowBeginCenter);

            setAttributes(begin, {
                style: 'display:block;',
                d: 'M'
                    .concat(arrowBeginA.x, ',')
                    .concat(arrowBeginA.y, ' L')
                    .concat(origin.x, ',')
                    .concat(origin.y, ' L')
                    .concat(arrowBeginB.x, ',')
                    .concat(arrowBeginB.y),
            });
        }

        if (markup.lineDecoration.indexOf('arrow-end') !== -1) {
            var arrowEndRotationPoint = vectorMultiply(v, -l);
            var arrowEndCenter = vectorAdd(target, arrowEndRotationPoint);
            var arrowEndA = vectorRotate(target, 2, arrowEndCenter);
            var arrowEndB = vectorRotate(target, -2, arrowEndCenter);

            setAttributes(end, {
                style: 'display:block;',
                d: 'M'
                    .concat(arrowEndA.x, ',')
                    .concat(arrowEndA.y, ' L')
                    .concat(target.x, ',')
                    .concat(target.y, ' L')
                    .concat(arrowEndB.x, ',')
                    .concat(arrowEndB.y),
            });
        }
    };

    var updatePath = function updatePath(element, markup, size, scale) {
        setAttributes(
            element,
            Object.assign({}, element.styles, {
                fill: 'none',
                d: pointsToPathShape(
                    markup.points.map(function(point) {
                        return {
                            x: getMarkupValue(point.x, size, scale, 'width'),
                            y: getMarkupValue(point.y, size, scale, 'height'),
                        };
                    })
                ),
            })
        );
    };

    var createShape = function createShape(node) {
        return function(markup) {
            return svg(node, { id: markup.id });
        };
    };

    var createImage = function createImage(markup) {
        var shape = svg('image', {
            id: markup.id,
            'stroke-linecap': 'round',
            'stroke-linejoin': 'round',
            opacity: '0',
        });

        shape.onload = function() {
            shape.setAttribute('opacity', markup.opacity || 1);
        };
        shape.setAttributeNS('http://www.w3.org/1999/xlink', 'xlink:href', markup.src);
        return shape;
    };

    var createLine = function createLine(markup) {
        var shape = svg('g', {
            id: markup.id,
            'stroke-linecap': 'round',
            'stroke-linejoin': 'round',
        });

        var line = svg('line');
        shape.appendChild(line);

        var begin = svg('path');
        shape.appendChild(begin);

        var end = svg('path');
        shape.appendChild(end);

        return shape;
    };

    var CREATE_TYPE_ROUTES = {
        image: createImage,
        rect: createShape('rect'),
        ellipse: createShape('ellipse'),
        text: createShape('text'),
        path: createShape('path'),
        line: createLine,
    };

    var UPDATE_TYPE_ROUTES = {
        rect: updateRect,
        ellipse: updateEllipse,
        image: updateImage,
        text: updateText,
        path: updatePath,
        line: updateLine,
    };

    var createMarkupByType = function createMarkupByType(type, markup) {
        return CREATE_TYPE_ROUTES[type](markup);
    };

    var updateMarkupByType = function updateMarkupByType(element, type, markup, size, scale) {
        if (type !== 'path') {
            element.rect = getMarkupRect(markup, size, scale);
        }
        element.styles = getMarkupStyles(markup, size, scale);
        UPDATE_TYPE_ROUTES[type](element, markup, size, scale);
    };

    var sortMarkupByZIndex = function sortMarkupByZIndex(a, b) {
        if (a[1].zIndex > b[1].zIndex) {
            return 1;
        }
        if (a[1].zIndex < b[1].zIndex) {
            return -1;
        }
        return 0;
    };

    var cropSVG = function cropSVG(blob) {
        var crop = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
        var markup = arguments.length > 2 ? arguments[2] : undefined;
        var options = arguments.length > 3 ? arguments[3] : undefined;
        return new Promise(function(resolve) {
            var _options$background = options.background,
                background = _options$background === void 0 ? null : _options$background;

            // load blob contents and wrap in crop svg
            var fr = new FileReader();
            fr.onloadend = function() {
                // get svg text
                var text = fr.result;

                // create element with svg and get size
                var original = document.createElement('div');
                original.style.cssText =
                    'position:absolute;pointer-events:none;width:0;height:0;visibility:hidden;';
                original.innerHTML = text;
                var originalNode = original.querySelector('svg');
                document.body.appendChild(original);

                // request bounding box dimensions
                var bBox = originalNode.getBBox();
                original.parentNode.removeChild(original);

                // get title
                var titleNode = original.querySelector('title');

                // calculate new heights and widths
                var viewBoxAttribute = originalNode.getAttribute('viewBox') || '';
                var widthAttribute = originalNode.getAttribute('width') || '';
                var heightAttribute = originalNode.getAttribute('height') || '';
                var width = parseFloat(widthAttribute) || null;
                var height = parseFloat(heightAttribute) || null;
                var widthUnits = (widthAttribute.match(/[a-z]+/) || [])[0] || '';
                var heightUnits = (heightAttribute.match(/[a-z]+/) || [])[0] || '';

                // create new size
                var viewBoxList = viewBoxAttribute.split(' ').map(parseFloat);
                var viewBox = viewBoxList.length
                    ? {
                          x: viewBoxList[0],
                          y: viewBoxList[1],
                          width: viewBoxList[2],
                          height: viewBoxList[3],
                      }
                    : bBox;

                var imageWidth = width != null ? width : viewBox.width;
                var imageHeight = height != null ? height : viewBox.height;

                originalNode.style.overflow = 'visible';
                originalNode.setAttribute('width', imageWidth);
                originalNode.setAttribute('height', imageHeight);

                // markup
                var markupSVG = '';
                if (markup && markup.length) {
                    var size = {
                        width: imageWidth,
                        height: imageHeight,
                    };

                    markupSVG = markup.sort(sortMarkupByZIndex).reduce(function(prev, shape) {
                        var el = createMarkupByType(shape[0], shape[1]);
                        updateMarkupByType(el, shape[0], shape[1], size);
                        el.removeAttribute('id');
                        if (el.getAttribute('opacity') === 1) {
                            el.removeAttribute('opacity');
                        }
                        return prev + '\n' + el.outerHTML + '\n';
                    }, '');
                    markupSVG = '\n\n<g>'.concat(markupSVG.replace(/&nbsp;/g, ' '), '</g>\n\n');
                }

                var aspectRatio = crop.aspectRatio || imageHeight / imageWidth;

                var canvasWidth = imageWidth;
                var canvasHeight = canvasWidth * aspectRatio;

                var shouldLimit = typeof crop.scaleToFit === 'undefined' || crop.scaleToFit;

                var cropCenterX = crop.center ? crop.center.x : 0.5;
                var cropCenterY = crop.center ? crop.center.y : 0.5;

                var canvasZoomFactor = getImageRectZoomFactor(
                    {
                        width: imageWidth,
                        height: imageHeight,
                    },

                    getCenteredCropRect(
                        {
                            width: canvasWidth,
                            height: canvasHeight,
                        },

                        aspectRatio
                    ),

                    crop.rotation,
                    shouldLimit
                        ? { x: cropCenterX, y: cropCenterY }
                        : {
                              x: 0.5,
                              y: 0.5,
                          }
                );

                var scale = crop.zoom * canvasZoomFactor;

                var rotation = crop.rotation * (180 / Math.PI);

                var canvasCenter = {
                    x: canvasWidth * 0.5,
                    y: canvasHeight * 0.5,
                };

                var imageOffset = {
                    x: canvasCenter.x - imageWidth * cropCenterX,
                    y: canvasCenter.y - imageHeight * cropCenterY,
                };

                var cropTransforms = [
                    // rotate
                    'rotate('
                        .concat(rotation, ' ')
                        .concat(canvasCenter.x, ' ')
                        .concat(canvasCenter.y, ')'),

                    // scale
                    'translate('.concat(canvasCenter.x, ' ').concat(canvasCenter.y, ')'),
                    'scale('.concat(scale, ')'),
                    'translate('.concat(-canvasCenter.x, ' ').concat(-canvasCenter.y, ')'),

                    // offset
                    'translate('.concat(imageOffset.x, ' ').concat(imageOffset.y, ')'),
                ];

                var cropFlipHorizontal = crop.flip && crop.flip.horizontal;
                var cropFlipVertical = crop.flip && crop.flip.vertical;

                var flipTransforms = [
                    'scale('
                        .concat(cropFlipHorizontal ? -1 : 1, ' ')
                        .concat(cropFlipVertical ? -1 : 1, ')'),
                    'translate('
                        .concat(cropFlipHorizontal ? -imageWidth : 0, ' ')
                        .concat(cropFlipVertical ? -imageHeight : 0, ')'),
                ];

                // crop
                var transformed = '<?xml version="1.0" encoding="UTF-8"?>\n<svg width="'
                    .concat(canvasWidth)
                    .concat(widthUnits, '" height="')
                    .concat(canvasHeight)
                    .concat(heightUnits, '" \nviewBox="0 0 ')
                    .concat(canvasWidth, ' ')
                    .concat(canvasHeight, '" ')
                    .concat(
                        background ? 'style="background:' + background + '" ' : '',
                        '\npreserveAspectRatio="xMinYMin"\nxmlns:xlink="http://www.w3.org/1999/xlink"\nxmlns="http://www.w3.org/2000/svg">\n<!-- Generated by PQINA - https://pqina.nl/ -->\n<title>'
                    )
                    .concat(titleNode ? titleNode.textContent : '', '</title>\n<g transform="')
                    .concat(cropTransforms.join(' '), '">\n<g transform="')
                    .concat(flipTransforms.join(' '), '">\n')
                    .concat(originalNode.outerHTML)
                    .concat(markupSVG, '\n</g>\n</g>\n</svg>');

                // create new svg file
                resolve(transformed);
            };

            fr.readAsText(blob);
        });
    };

    var objectToImageData = function objectToImageData(obj) {
        var imageData;
        try {
            imageData = new ImageData(obj.width, obj.height);
        } catch (e) {
            // IE + Old EDGE (tested on 12)
            var canvas = document.createElement('canvas');
            imageData = canvas.getContext('2d').createImageData(obj.width, obj.height);
        }
        imageData.data.set(obj.data);
        return imageData;
    };

    /* javascript-obfuscator:disable */
    var TransformWorker = function TransformWorker() {
        // maps transform types to transform functions
        var TRANSFORMS = { resize: resize, filter: filter };

        // applies all image transforms to the image data array
        var applyTransforms = function applyTransforms(transforms, imageData) {
            transforms.forEach(function(transform) {
                imageData = TRANSFORMS[transform.type](imageData, transform.data);
            });
            return imageData;
        };

        // transform image hub
        var transform = function transform(data, cb) {
            var transforms = data.transforms;

            // if has filter and has resize, move filter to resize operation
            var filterTransform = null;
            transforms.forEach(function(transform) {
                if (transform.type === 'filter') {
                    filterTransform = transform;
                }
            });
            if (filterTransform) {
                // find resize
                var resizeTransform = null;
                transforms.forEach(function(transform) {
                    if (transform.type === 'resize') {
                        resizeTransform = transform;
                    }
                });

                if (resizeTransform) {
                    // update resize operation
                    resizeTransform.data.matrix = filterTransform.data;

                    // remove filter
                    transforms = transforms.filter(function(transform) {
                        return transform.type !== 'filter';
                    });
                }
            }

            cb(applyTransforms(transforms, data.imageData));
        };

        // eslint-disable-next-line no-restricted-globals
        self.onmessage = function(e) {
            transform(e.data.message, function(response) {
                // eslint-disable-next-line no-restricted-globals
                self.postMessage({ id: e.data.id, message: response }, [response.data.buffer]);
            });
        };

        var br = 1.0;
        var bg = 1.0;
        var bb = 1.0;
        function applyFilterMatrix(index, data, m) {
            var ir = data[index] / 255;
            var ig = data[index + 1] / 255;
            var ib = data[index + 2] / 255;
            var ia = data[index + 3] / 255;

            var mr = ir * m[0] + ig * m[1] + ib * m[2] + ia * m[3] + m[4];
            var mg = ir * m[5] + ig * m[6] + ib * m[7] + ia * m[8] + m[9];
            var mb = ir * m[10] + ig * m[11] + ib * m[12] + ia * m[13] + m[14];
            var ma = ir * m[15] + ig * m[16] + ib * m[17] + ia * m[18] + m[19];

            var or = Math.max(0, mr * ma) + br * (1.0 - ma);
            var og = Math.max(0, mg * ma) + bg * (1.0 - ma);
            var ob = Math.max(0, mb * ma) + bb * (1.0 - ma);

            data[index] = Math.max(0.0, Math.min(1.0, or)) * 255;
            data[index + 1] = Math.max(0.0, Math.min(1.0, og)) * 255;
            data[index + 2] = Math.max(0.0, Math.min(1.0, ob)) * 255;
        }

        var identityMatrix = self.JSON.stringify([
            1,
            0,
            0,
            0,
            0,
            0,
            1,
            0,
            0,
            0,
            0,
            0,
            1,
            0,
            0,
            0,
            0,
            0,
            1,
            0,
        ]);
        function isIdentityMatrix(filter) {
            return self.JSON.stringify(filter || []) === identityMatrix;
        }

        function filter(imageData, matrix) {
            if (!matrix || isIdentityMatrix(matrix)) return imageData;

            var data = imageData.data;
            var l = data.length;

            var m11 = matrix[0];
            var m12 = matrix[1];
            var m13 = matrix[2];
            var m14 = matrix[3];
            var m15 = matrix[4];

            var m21 = matrix[5];
            var m22 = matrix[6];
            var m23 = matrix[7];
            var m24 = matrix[8];
            var m25 = matrix[9];

            var m31 = matrix[10];
            var m32 = matrix[11];
            var m33 = matrix[12];
            var m34 = matrix[13];
            var m35 = matrix[14];

            var m41 = matrix[15];
            var m42 = matrix[16];
            var m43 = matrix[17];
            var m44 = matrix[18];
            var m45 = matrix[19];

            var index = 0,
                r = 0.0,
                g = 0.0,
                b = 0.0,
                a = 0.0,
                mr = 0.0,
                mg = 0.0,
                mb = 0.0,
                ma = 0.0,
                or = 0.0,
                og = 0.0,
                ob = 0.0;

            for (; index < l; index += 4) {
                r = data[index] / 255;
                g = data[index + 1] / 255;
                b = data[index + 2] / 255;
                a = data[index + 3] / 255;

                mr = r * m11 + g * m12 + b * m13 + a * m14 + m15;
                mg = r * m21 + g * m22 + b * m23 + a * m24 + m25;
                mb = r * m31 + g * m32 + b * m33 + a * m34 + m35;
                ma = r * m41 + g * m42 + b * m43 + a * m44 + m45;

                or = Math.max(0, mr * ma) + br * (1.0 - ma);
                og = Math.max(0, mg * ma) + bg * (1.0 - ma);
                ob = Math.max(0, mb * ma) + bb * (1.0 - ma);

                data[index] = Math.max(0.0, Math.min(1.0, or)) * 255;
                data[index + 1] = Math.max(0.0, Math.min(1.0, og)) * 255;
                data[index + 2] = Math.max(0.0, Math.min(1.0, ob)) * 255;
                // don't update alpha value
            }

            return imageData;
        }

        function resize(imageData, data) {
            var _data$mode = data.mode,
                mode = _data$mode === void 0 ? 'contain' : _data$mode,
                _data$upscale = data.upscale,
                upscale = _data$upscale === void 0 ? false : _data$upscale,
                width = data.width,
                height = data.height,
                matrix = data.matrix;

            // test if is identity matrix
            matrix = !matrix || isIdentityMatrix(matrix) ? null : matrix;

            // need at least a width or a height
            // also 0 is not a valid width or height
            if (!width && !height) {
                return filter(imageData, matrix);
            }

            // make sure all bounds are set
            if (width === null) {
                width = height;
            } else if (height === null) {
                height = width;
            }

            if (mode !== 'force') {
                var scalarWidth = width / imageData.width;
                var scalarHeight = height / imageData.height;
                var scalar = 1;

                if (mode === 'cover') {
                    scalar = Math.max(scalarWidth, scalarHeight);
                } else if (mode === 'contain') {
                    scalar = Math.min(scalarWidth, scalarHeight);
                }

                // if image is too small, exit here with original image
                if (scalar > 1 && upscale === false) {
                    return filter(imageData, matrix);
                }

                width = imageData.width * scalar;
                height = imageData.height * scalar;
            }

            var originWidth = imageData.width;
            var originHeight = imageData.height;
            var targetWidth = Math.round(width);
            var targetHeight = Math.round(height);
            var inputData = imageData.data;
            var outputData = new Uint8ClampedArray(targetWidth * targetHeight * 4);
            var ratioWidth = originWidth / targetWidth;
            var ratioHeight = originHeight / targetHeight;
            var ratioWidthHalf = Math.ceil(ratioWidth * 0.5);
            var ratioHeightHalf = Math.ceil(ratioHeight * 0.5);

            for (var j = 0; j < targetHeight; j++) {
                for (var i = 0; i < targetWidth; i++) {
                    var x2 = (i + j * targetWidth) * 4;
                    var weight = 0;
                    var weights = 0;
                    var weightsAlpha = 0;
                    var r = 0;
                    var g = 0;
                    var b = 0;
                    var a = 0;
                    var centerY = (j + 0.5) * ratioHeight;

                    for (var yy = Math.floor(j * ratioHeight); yy < (j + 1) * ratioHeight; yy++) {
                        var dy = Math.abs(centerY - (yy + 0.5)) / ratioHeightHalf;
                        var centerX = (i + 0.5) * ratioWidth;
                        var w0 = dy * dy;

                        for (var xx = Math.floor(i * ratioWidth); xx < (i + 1) * ratioWidth; xx++) {
                            var dx = Math.abs(centerX - (xx + 0.5)) / ratioWidthHalf;
                            var w = Math.sqrt(w0 + dx * dx);

                            if (w >= -1 && w <= 1) {
                                weight = 2 * w * w * w - 3 * w * w + 1;

                                if (weight > 0) {
                                    dx = 4 * (xx + yy * originWidth);

                                    var ref = inputData[dx + 3];
                                    a += weight * ref;
                                    weightsAlpha += weight;

                                    if (ref < 255) {
                                        weight = (weight * ref) / 250;
                                    }

                                    r += weight * inputData[dx];
                                    g += weight * inputData[dx + 1];
                                    b += weight * inputData[dx + 2];
                                    weights += weight;
                                }
                            }
                        }
                    }

                    outputData[x2] = r / weights;
                    outputData[x2 + 1] = g / weights;
                    outputData[x2 + 2] = b / weights;
                    outputData[x2 + 3] = a / weightsAlpha;

                    matrix && applyFilterMatrix(x2, outputData, matrix);
                }
            }

            return {
                data: outputData,
                width: targetWidth,
                height: targetHeight,
            };
        }
    };
    /* javascript-obfuscator:enable */

    var correctOrientation = function correctOrientation(view, offset) {
        // Missing 0x45786966 Marker? No Exif Header, stop here
        if (view.getUint32(offset + 4, false) !== 0x45786966) return;

        // next byte!
        offset += 4;

        // First 2bytes defines byte align of TIFF data.
        // If it is 0x4949="I I", it means "Intel" type byte align
        var intelByteAligned = view.getUint16((offset += 6), false) === 0x4949;
        offset += view.getUint32(offset + 4, intelByteAligned);

        var tags = view.getUint16(offset, intelByteAligned);
        offset += 2;

        // find Orientation tag
        for (var i = 0; i < tags; i++) {
            if (view.getUint16(offset + i * 12, intelByteAligned) === 0x0112) {
                view.setUint16(offset + i * 12 + 8, 1, intelByteAligned);
                return true;
            }
        }
        return false;
    };

    var readData = function readData(data) {
        var view = new DataView(data);

        // Every JPEG file starts from binary value '0xFFD8'
        // If it's not present, exit here
        if (view.getUint16(0) !== 0xffd8) return null;

        var offset = 2; // Start at 2 as we skipped two bytes (FFD8)
        var marker;
        var markerLength;
        var orientationCorrected = false;

        while (offset < view.byteLength) {
            marker = view.getUint16(offset, false);
            markerLength = view.getUint16(offset + 2, false) + 2;

            // Test if is APP and COM markers
            var isData = (marker >= 0xffe0 && marker <= 0xffef) || marker === 0xfffe;
            if (!isData) {
                break;
            }

            if (!orientationCorrected) {
                orientationCorrected = correctOrientation(view, offset, markerLength);
            }

            if (offset + markerLength > view.byteLength) {
                break;
            }

            offset += markerLength;
        }
        return data.slice(0, offset);
    };

    var getImageHead = function getImageHead(file) {
        return new Promise(function(resolve) {
            var reader = new FileReader();
            reader.onload = function() {
                return resolve(readData(reader.result) || null);
            };
            reader.readAsArrayBuffer(file.slice(0, 256 * 1024));
        });
    };

    var getBlobBuilder = function getBlobBuilder() {
        return (window.BlobBuilder =
            window.BlobBuilder ||
            window.WebKitBlobBuilder ||
            window.MozBlobBuilder ||
            window.MSBlobBuilder);
    };

    var createBlob = function createBlob(arrayBuffer, mimeType) {
        var BB = getBlobBuilder();

        if (BB) {
            var bb = new BB();
            bb.append(arrayBuffer);
            return bb.getBlob(mimeType);
        }

        return new Blob([arrayBuffer], {
            type: mimeType,
        });
    };

    var getUniqueId = function getUniqueId() {
        return Math.random()
            .toString(36)
            .substr(2, 9);
    };

    var createWorker = function createWorker(fn) {
        var workerBlob = new Blob(['(', fn.toString(), ')()'], { type: 'application/javascript' });
        var workerURL = URL.createObjectURL(workerBlob);
        var worker = new Worker(workerURL);

        var trips = [];

        return {
            transfer: function transfer() {}, // (message, cb) => {}
            post: function post(message, cb, transferList) {
                var id = getUniqueId();
                trips[id] = cb;

                worker.onmessage = function(e) {
                    var cb = trips[e.data.id];
                    if (!cb) return;
                    cb(e.data.message);
                    delete trips[e.data.id];
                };

                worker.postMessage(
                    {
                        id: id,
                        message: message,
                    },

                    transferList
                );
            },
            terminate: function terminate() {
                worker.terminate();
                URL.revokeObjectURL(workerURL);
            },
        };
    };

    var loadImage = function loadImage(url) {
        return new Promise(function(resolve, reject) {
            var img = new Image();
            img.onload = function() {
                resolve(img);
            };
            img.onerror = function(e) {
                reject(e);
            };
            img.src = url;
        });
    };

    var chain = function chain(funcs) {
        return funcs.reduce(function(promise, func) {
            return promise.then(function(result) {
                return func().then(Array.prototype.concat.bind(result));
            });
        }, Promise.resolve([]));
    };

    var canvasApplyMarkup = function canvasApplyMarkup(canvas, markup) {
        return new Promise(function(resolve) {
            var size = {
                width: canvas.width,
                height: canvas.height,
            };

            var ctx = canvas.getContext('2d');

            var drawers = markup.sort(sortMarkupByZIndex).map(function(item) {
                return function() {
                    return new Promise(function(resolve) {
                        var result = TYPE_DRAW_ROUTES[item[0]](ctx, size, item[1], resolve);
                        if (result) resolve();
                    });
                };
            });

            chain(drawers).then(function() {
                return resolve(canvas);
            });
        });
    };

    var applyMarkupStyles = function applyMarkupStyles(ctx, styles) {
        ctx.beginPath();
        ctx.lineCap = styles['stroke-linecap'];
        ctx.lineJoin = styles['stroke-linejoin'];
        ctx.lineWidth = styles['stroke-width'];
        if (styles['stroke-dasharray'].length) {
            ctx.setLineDash(styles['stroke-dasharray'].split(','));
        }
        ctx.fillStyle = styles['fill'];
        ctx.strokeStyle = styles['stroke'];
        ctx.globalAlpha = styles.opacity || 1;
    };

    var drawMarkupStyles = function drawMarkupStyles(ctx) {
        ctx.fill();
        ctx.stroke();
        ctx.globalAlpha = 1;
    };

    var drawRect = function drawRect(ctx, size, markup) {
        var rect = getMarkupRect(markup, size);
        var styles = getMarkupStyles(markup, size);
        applyMarkupStyles(ctx, styles);
        ctx.rect(rect.x, rect.y, rect.width, rect.height);
        drawMarkupStyles(ctx, styles);
        return true;
    };

    var drawEllipse = function drawEllipse(ctx, size, markup) {
        var rect = getMarkupRect(markup, size);
        var styles = getMarkupStyles(markup, size);
        applyMarkupStyles(ctx, styles);

        var x = rect.x,
            y = rect.y,
            w = rect.width,
            h = rect.height,
            kappa = 0.5522848,
            ox = (w / 2) * kappa,
            oy = (h / 2) * kappa,
            xe = x + w,
            ye = y + h,
            xm = x + w / 2,
            ym = y + h / 2;

        ctx.moveTo(x, ym);
        ctx.bezierCurveTo(x, ym - oy, xm - ox, y, xm, y);
        ctx.bezierCurveTo(xm + ox, y, xe, ym - oy, xe, ym);
        ctx.bezierCurveTo(xe, ym + oy, xm + ox, ye, xm, ye);
        ctx.bezierCurveTo(xm - ox, ye, x, ym + oy, x, ym);

        drawMarkupStyles(ctx, styles);
        return true;
    };

    var drawImage = function drawImage(ctx, size, markup, done) {
        var rect = getMarkupRect(markup, size);
        var styles = getMarkupStyles(markup, size);
        applyMarkupStyles(ctx, styles);

        var image = new Image();

        // if is cross origin image add cross origin attribute
        var isCrossOriginImage =
            new URL(markup.src, window.location.href).origin !== window.location.origin;
        if (isCrossOriginImage) image.crossOrigin = '';

        image.onload = function() {
            if (markup.fit === 'cover') {
                var ar = rect.width / rect.height;
                var width = ar > 1 ? image.width : image.height * ar;
                var height = ar > 1 ? image.width / ar : image.height;
                var x = image.width * 0.5 - width * 0.5;
                var y = image.height * 0.5 - height * 0.5;
                ctx.drawImage(image, x, y, width, height, rect.x, rect.y, rect.width, rect.height);
            } else if (markup.fit === 'contain') {
                var scalar = Math.min(rect.width / image.width, rect.height / image.height);
                var _width = scalar * image.width;
                var _height = scalar * image.height;
                var _x = rect.x + rect.width * 0.5 - _width * 0.5;
                var _y = rect.y + rect.height * 0.5 - _height * 0.5;
                ctx.drawImage(image, 0, 0, image.width, image.height, _x, _y, _width, _height);
            } else {
                ctx.drawImage(
                    image,
                    0,
                    0,
                    image.width,
                    image.height,
                    rect.x,
                    rect.y,
                    rect.width,
                    rect.height
                );
            }

            drawMarkupStyles(ctx, styles);
            done();
        };
        image.src = markup.src;
    };

    var drawText = function drawText(ctx, size, markup) {
        var rect = getMarkupRect(markup, size);
        var styles = getMarkupStyles(markup, size);
        applyMarkupStyles(ctx, styles);

        var fontSize = getMarkupValue(markup.fontSize, size);
        var fontFamily = markup.fontFamily || 'sans-serif';
        var fontWeight = markup.fontWeight || 'normal';
        var textAlign = markup.textAlign || 'left';

        ctx.font = ''
            .concat(fontWeight, ' ')
            .concat(fontSize, 'px ')
            .concat(fontFamily);
        ctx.textAlign = textAlign;
        ctx.fillText(markup.text, rect.x, rect.y);

        drawMarkupStyles(ctx, styles);
        return true;
    };

    var drawPath = function drawPath(ctx, size, markup) {
        var styles = getMarkupStyles(markup, size);
        applyMarkupStyles(ctx, styles);
        ctx.beginPath();

        var points = markup.points.map(function(point) {
            return {
                x: getMarkupValue(point.x, size, 1, 'width'),
                y: getMarkupValue(point.y, size, 1, 'height'),
            };
        });

        ctx.moveTo(points[0].x, points[0].y);
        var l = points.length;
        for (var i = 1; i < l; i++) {
            ctx.lineTo(points[i].x, points[i].y);
        }

        drawMarkupStyles(ctx, styles);
        return true;
    };

    var drawLine = function drawLine(ctx, size, markup) {
        var rect = getMarkupRect(markup, size);
        var styles = getMarkupStyles(markup, size);
        applyMarkupStyles(ctx, styles);

        ctx.beginPath();

        var origin = {
            x: rect.x,
            y: rect.y,
        };

        var target = {
            x: rect.x + rect.width,
            y: rect.y + rect.height,
        };

        ctx.moveTo(origin.x, origin.y);
        ctx.lineTo(target.x, target.y);

        var v = vectorNormalize({
            x: target.x - origin.x,
            y: target.y - origin.y,
        });

        var l = 0.04 * Math.min(size.width, size.height);

        if (markup.lineDecoration.indexOf('arrow-begin') !== -1) {
            var arrowBeginRotationPoint = vectorMultiply(v, l);
            var arrowBeginCenter = vectorAdd(origin, arrowBeginRotationPoint);
            var arrowBeginA = vectorRotate(origin, 2, arrowBeginCenter);
            var arrowBeginB = vectorRotate(origin, -2, arrowBeginCenter);

            ctx.moveTo(arrowBeginA.x, arrowBeginA.y);
            ctx.lineTo(origin.x, origin.y);
            ctx.lineTo(arrowBeginB.x, arrowBeginB.y);
        }
        if (markup.lineDecoration.indexOf('arrow-end') !== -1) {
            var arrowEndRotationPoint = vectorMultiply(v, -l);
            var arrowEndCenter = vectorAdd(target, arrowEndRotationPoint);
            var arrowEndA = vectorRotate(target, 2, arrowEndCenter);
            var arrowEndB = vectorRotate(target, -2, arrowEndCenter);

            ctx.moveTo(arrowEndA.x, arrowEndA.y);
            ctx.lineTo(target.x, target.y);
            ctx.lineTo(arrowEndB.x, arrowEndB.y);
        }

        drawMarkupStyles(ctx, styles);
        return true;
    };

    var TYPE_DRAW_ROUTES = {
        rect: drawRect,
        ellipse: drawEllipse,
        image: drawImage,
        text: drawText,
        line: drawLine,
        path: drawPath,
    };

    var imageDataToCanvas = function imageDataToCanvas(imageData) {
        var image = document.createElement('canvas');
        image.width = imageData.width;
        image.height = imageData.height;
        var ctx = image.getContext('2d');
        ctx.putImageData(imageData, 0, 0);
        return image;
    };

    var transformImage = function transformImage(file, instructions) {
        var options = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
        return new Promise(function(resolve, reject) {
            // if the file is not an image we do not have any business transforming it
            if (!file || !isImage$1(file))
                return reject({ status: 'not an image file', file: file });

            // get separate options for easier use
            var stripImageHead = options.stripImageHead,
                beforeCreateBlob = options.beforeCreateBlob,
                afterCreateBlob = options.afterCreateBlob,
                canvasMemoryLimit = options.canvasMemoryLimit;

            // get crop
            var crop = instructions.crop,
                size = instructions.size,
                filter = instructions.filter,
                markup = instructions.markup,
                output = instructions.output;

            // get exif orientation
            var orientation =
                instructions.image && instructions.image.orientation
                    ? Math.max(1, Math.min(8, instructions.image.orientation))
                    : null;

            // compression quality 0 => 100
            var qualityAsPercentage = output && output.quality;
            var quality = qualityAsPercentage === null ? null : qualityAsPercentage / 100;

            // output format
            var type = (output && output.type) || null;

            // background color
            var background = (output && output.background) || null;

            // get transforms
            var transforms = [];

            // add resize transforms if set
            if (size && (typeof size.width === 'number' || typeof size.height === 'number')) {
                transforms.push({ type: 'resize', data: size });
            }

            // add filters
            if (filter && filter.length === 20) {
                transforms.push({ type: 'filter', data: filter });
            }

            // resolves with supplied blob
            var resolveWithBlob = function resolveWithBlob(blob) {
                var promisedBlob = afterCreateBlob ? afterCreateBlob(blob) : blob;
                Promise.resolve(promisedBlob).then(resolve);
            };

            // done
            var toBlob = function toBlob(imageData, options) {
                var canvas = imageDataToCanvas(imageData);
                var promisedCanvas = markup.length ? canvasApplyMarkup(canvas, markup) : canvas;
                Promise.resolve(promisedCanvas).then(function(canvas) {
                    canvasToBlob(canvas, options, beforeCreateBlob)
                        .then(function(blob) {
                            // force release of canvas memory
                            canvasRelease(canvas);

                            // remove image head (default)
                            if (stripImageHead) return resolveWithBlob(blob);

                            // try to copy image head from original file to generated blob
                            getImageHead(file).then(function(imageHead) {
                                // re-inject image head in case of JPEG, as the image head is removed by canvas export
                                if (imageHead !== null) {
                                    blob = new Blob([imageHead, blob.slice(20)], {
                                        type: blob.type,
                                    });
                                }

                                // done!
                                resolveWithBlob(blob);
                            });
                        })
                        .catch(reject);
                });
            };

            // if this is an svg and we want it to stay an svg
            if (/svg/.test(file.type) && type === null) {
                return cropSVG(file, crop, markup, { background: background }).then(function(text) {
                    resolve(createBlob(text, 'image/svg+xml'));
                });
            }

            // get file url
            var url = URL.createObjectURL(file);

            // turn the file into an image
            loadImage(url)
                .then(function(image) {
                    // url is no longer needed
                    URL.revokeObjectURL(url);

                    // draw to canvas and start transform chain
                    var imageData = imageToImageData(image, orientation, crop, {
                        canvasMemoryLimit: canvasMemoryLimit,
                        background: background,
                    });

                    // determine the format of the blob that we will output
                    var outputFormat = {
                        quality: quality,
                        type: type || file.type,
                    };

                    // no transforms necessary, we done!
                    if (!transforms.length) {
                        return toBlob(imageData, outputFormat);
                    }

                    // send to the transform worker to transform the blob on a separate thread
                    var worker = createWorker(TransformWorker);
                    worker.post(
                        {
                            transforms: transforms,
                            imageData: imageData,
                        },

                        function(response) {
                            // finish up
                            toBlob(objectToImageData(response), outputFormat);

                            // stop worker
                            worker.terminate();
                        },
                        [imageData.data.buffer]
                    );
                })
                .catch(reject);
        });
    };

    function _typeof(obj) {
        if (typeof Symbol === 'function' && typeof Symbol.iterator === 'symbol') {
            _typeof = function(obj) {
                return typeof obj;
            };
        } else {
            _typeof = function(obj) {
                return obj &&
                    typeof Symbol === 'function' &&
                    obj.constructor === Symbol &&
                    obj !== Symbol.prototype
                    ? 'symbol'
                    : typeof obj;
            };
        }

        return _typeof(obj);
    }

    var REACT_ELEMENT_TYPE;

    function _jsx(type, props, key, children) {
        if (!REACT_ELEMENT_TYPE) {
            REACT_ELEMENT_TYPE =
                (typeof Symbol === 'function' && Symbol.for && Symbol.for('react.element')) ||
                0xeac7;
        }

        var defaultProps = type && type.defaultProps;
        var childrenLength = arguments.length - 3;

        if (!props && childrenLength !== 0) {
            props = {
                children: void 0,
            };
        }

        if (props && defaultProps) {
            for (var propName in defaultProps) {
                if (props[propName] === void 0) {
                    props[propName] = defaultProps[propName];
                }
            }
        } else if (!props) {
            props = defaultProps || {};
        }

        if (childrenLength === 1) {
            props.children = children;
        } else if (childrenLength > 1) {
            var childArray = new Array(childrenLength);

            for (var i = 0; i < childrenLength; i++) {
                childArray[i] = arguments[i + 3];
            }

            props.children = childArray;
        }

        return {
            $$typeof: REACT_ELEMENT_TYPE,
            type: type,
            key: key === undefined ? null : '' + key,
            ref: null,
            props: props,
            _owner: null,
        };
    }

    function _asyncIterator(iterable) {
        var method;

        if (typeof Symbol === 'function') {
            if (Symbol.asyncIterator) {
                method = iterable[Symbol.asyncIterator];
                if (method != null) return method.call(iterable);
            }

            if (Symbol.iterator) {
                method = iterable[Symbol.iterator];
                if (method != null) return method.call(iterable);
            }
        }

        throw new TypeError('Object is not async iterable');
    }

    function _AwaitValue(value) {
        this.wrapped = value;
    }

    function _AsyncGenerator(gen) {
        var front, back;

        function send(key, arg) {
            return new Promise(function(resolve, reject) {
                var request = {
                    key: key,
                    arg: arg,
                    resolve: resolve,
                    reject: reject,
                    next: null,
                };

                if (back) {
                    back = back.next = request;
                } else {
                    front = back = request;
                    resume(key, arg);
                }
            });
        }

        function resume(key, arg) {
            try {
                var result = gen[key](arg);
                var value = result.value;
                var wrappedAwait = value instanceof _AwaitValue;
                Promise.resolve(wrappedAwait ? value.wrapped : value).then(
                    function(arg) {
                        if (wrappedAwait) {
                            resume('next', arg);
                            return;
                        }

                        settle(result.done ? 'return' : 'normal', arg);
                    },
                    function(err) {
                        resume('throw', err);
                    }
                );
            } catch (err) {
                settle('throw', err);
            }
        }

        function settle(type, value) {
            switch (type) {
                case 'return':
                    front.resolve({
                        value: value,
                        done: true,
                    });
                    break;

                case 'throw':
                    front.reject(value);
                    break;

                default:
                    front.resolve({
                        value: value,
                        done: false,
                    });
                    break;
            }

            front = front.next;

            if (front) {
                resume(front.key, front.arg);
            } else {
                back = null;
            }
        }

        this._invoke = send;

        if (typeof gen.return !== 'function') {
            this.return = undefined;
        }
    }

    if (typeof Symbol === 'function' && Symbol.asyncIterator) {
        _AsyncGenerator.prototype[Symbol.asyncIterator] = function() {
            return this;
        };
    }

    _AsyncGenerator.prototype.next = function(arg) {
        return this._invoke('next', arg);
    };

    _AsyncGenerator.prototype.throw = function(arg) {
        return this._invoke('throw', arg);
    };

    _AsyncGenerator.prototype.return = function(arg) {
        return this._invoke('return', arg);
    };

    function _wrapAsyncGenerator(fn) {
        return function() {
            return new _AsyncGenerator(fn.apply(this, arguments));
        };
    }

    function _awaitAsyncGenerator(value) {
        return new _AwaitValue(value);
    }

    function _asyncGeneratorDelegate(inner, awaitWrap) {
        var iter = {},
            waiting = false;

        function pump(key, value) {
            waiting = true;
            value = new Promise(function(resolve) {
                resolve(inner[key](value));
            });
            return {
                done: false,
                value: awaitWrap(value),
            };
        }

        if (typeof Symbol === 'function' && Symbol.iterator) {
            iter[Symbol.iterator] = function() {
                return this;
            };
        }

        iter.next = function(value) {
            if (waiting) {
                waiting = false;
                return value;
            }

            return pump('next', value);
        };

        if (typeof inner.throw === 'function') {
            iter.throw = function(value) {
                if (waiting) {
                    waiting = false;
                    throw value;
                }

                return pump('throw', value);
            };
        }

        if (typeof inner.return === 'function') {
            iter.return = function(value) {
                return pump('return', value);
            };
        }

        return iter;
    }

    function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {
        try {
            var info = gen[key](arg);
            var value = info.value;
        } catch (error) {
            reject(error);
            return;
        }

        if (info.done) {
            resolve(value);
        } else {
            Promise.resolve(value).then(_next, _throw);
        }
    }

    function _asyncToGenerator(fn) {
        return function() {
            var self = this,
                args = arguments;
            return new Promise(function(resolve, reject) {
                var gen = fn.apply(self, args);

                function _next(value) {
                    asyncGeneratorStep(gen, resolve, reject, _next, _throw, 'next', value);
                }

                function _throw(err) {
                    asyncGeneratorStep(gen, resolve, reject, _next, _throw, 'throw', err);
                }

                _next(undefined);
            });
        };
    }

    function _classCallCheck(instance, Constructor) {
        if (!(instance instanceof Constructor)) {
            throw new TypeError('Cannot call a class as a function');
        }
    }

    function _defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || false;
            descriptor.configurable = true;
            if ('value' in descriptor) descriptor.writable = true;
            Object.defineProperty(target, descriptor.key, descriptor);
        }
    }

    function _createClass(Constructor, protoProps, staticProps) {
        if (protoProps) _defineProperties(Constructor.prototype, protoProps);
        if (staticProps) _defineProperties(Constructor, staticProps);
        return Constructor;
    }

    function _defineEnumerableProperties(obj, descs) {
        for (var key in descs) {
            var desc = descs[key];
            desc.configurable = desc.enumerable = true;
            if ('value' in desc) desc.writable = true;
            Object.defineProperty(obj, key, desc);
        }

        if (Object.getOwnPropertySymbols) {
            var objectSymbols = Object.getOwnPropertySymbols(descs);

            for (var i = 0; i < objectSymbols.length; i++) {
                var sym = objectSymbols[i];
                var desc = descs[sym];
                desc.configurable = desc.enumerable = true;
                if ('value' in desc) desc.writable = true;
                Object.defineProperty(obj, sym, desc);
            }
        }

        return obj;
    }

    function _defaults(obj, defaults) {
        var keys = Object.getOwnPropertyNames(defaults);

        for (var i = 0; i < keys.length; i++) {
            var key = keys[i];
            var value = Object.getOwnPropertyDescriptor(defaults, key);

            if (value && value.configurable && obj[key] === undefined) {
                Object.defineProperty(obj, key, value);
            }
        }

        return obj;
    }

    function _defineProperty(obj, key, value) {
        if (key in obj) {
            Object.defineProperty(obj, key, {
                value: value,
                enumerable: true,
                configurable: true,
                writable: true,
            });
        } else {
            obj[key] = value;
        }

        return obj;
    }

    function _extends() {
        _extends =
            Object.assign ||
            function(target) {
                for (var i = 1; i < arguments.length; i++) {
                    var source = arguments[i];

                    for (var key in source) {
                        if (Object.prototype.hasOwnProperty.call(source, key)) {
                            target[key] = source[key];
                        }
                    }
                }

                return target;
            };

        return _extends.apply(this, arguments);
    }

    function _objectSpread(target) {
        for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i] != null ? arguments[i] : {};
            var ownKeys = Object.keys(source);

            if (typeof Object.getOwnPropertySymbols === 'function') {
                ownKeys = ownKeys.concat(
                    Object.getOwnPropertySymbols(source).filter(function(sym) {
                        return Object.getOwnPropertyDescriptor(source, sym).enumerable;
                    })
                );
            }

            ownKeys.forEach(function(key) {
                _defineProperty(target, key, source[key]);
            });
        }

        return target;
    }

    function _inherits(subClass, superClass) {
        if (typeof superClass !== 'function' && superClass !== null) {
            throw new TypeError('Super expression must either be null or a function');
        }

        subClass.prototype = Object.create(superClass && superClass.prototype, {
            constructor: {
                value: subClass,
                writable: true,
                configurable: true,
            },
        });
        if (superClass) _setPrototypeOf(subClass, superClass);
    }

    function _inheritsLoose(subClass, superClass) {
        subClass.prototype = Object.create(superClass.prototype);
        subClass.prototype.constructor = subClass;
        subClass.__proto__ = superClass;
    }

    function _getPrototypeOf(o) {
        _getPrototypeOf = Object.setPrototypeOf
            ? Object.getPrototypeOf
            : function _getPrototypeOf(o) {
                  return o.__proto__ || Object.getPrototypeOf(o);
              };
        return _getPrototypeOf(o);
    }

    function _setPrototypeOf(o, p) {
        _setPrototypeOf =
            Object.setPrototypeOf ||
            function _setPrototypeOf(o, p) {
                o.__proto__ = p;
                return o;
            };

        return _setPrototypeOf(o, p);
    }

    function isNativeReflectConstruct() {
        if (typeof Reflect === 'undefined' || !Reflect.construct) return false;
        if (Reflect.construct.sham) return false;
        if (typeof Proxy === 'function') return true;

        try {
            Date.prototype.toString.call(Reflect.construct(Date, [], function() {}));
            return true;
        } catch (e) {
            return false;
        }
    }

    function _construct(Parent, args, Class) {
        if (isNativeReflectConstruct()) {
            _construct = Reflect.construct;
        } else {
            _construct = function _construct(Parent, args, Class) {
                var a = [null];
                a.push.apply(a, args);
                var Constructor = Function.bind.apply(Parent, a);
                var instance = new Constructor();
                if (Class) _setPrototypeOf(instance, Class.prototype);
                return instance;
            };
        }

        return _construct.apply(null, arguments);
    }

    function _isNativeFunction(fn) {
        return Function.toString.call(fn).indexOf('[native code]') !== -1;
    }

    function _wrapNativeSuper(Class) {
        var _cache = typeof Map === 'function' ? new Map() : undefined;

        _wrapNativeSuper = function _wrapNativeSuper(Class) {
            if (Class === null || !_isNativeFunction(Class)) return Class;

            if (typeof Class !== 'function') {
                throw new TypeError('Super expression must either be null or a function');
            }

            if (typeof _cache !== 'undefined') {
                if (_cache.has(Class)) return _cache.get(Class);

                _cache.set(Class, Wrapper);
            }

            function Wrapper() {
                return _construct(Class, arguments, _getPrototypeOf(this).constructor);
            }

            Wrapper.prototype = Object.create(Class.prototype, {
                constructor: {
                    value: Wrapper,
                    enumerable: false,
                    writable: true,
                    configurable: true,
                },
            });
            return _setPrototypeOf(Wrapper, Class);
        };

        return _wrapNativeSuper(Class);
    }

    function _instanceof(left, right) {
        if (right != null && typeof Symbol !== 'undefined' && right[Symbol.hasInstance]) {
            return right[Symbol.hasInstance](left);
        } else {
            return left instanceof right;
        }
    }

    function _interopRequireDefault(obj) {
        return obj && obj.__esModule
            ? obj
            : {
                  default: obj,
              };
    }

    function _interopRequireWildcard(obj) {
        if (obj && obj.__esModule) {
            return obj;
        } else {
            var newObj = {};

            if (obj != null) {
                for (var key in obj) {
                    if (Object.prototype.hasOwnProperty.call(obj, key)) {
                        var desc =
                            Object.defineProperty && Object.getOwnPropertyDescriptor
                                ? Object.getOwnPropertyDescriptor(obj, key)
                                : {};

                        if (desc.get || desc.set) {
                            Object.defineProperty(newObj, key, desc);
                        } else {
                            newObj[key] = obj[key];
                        }
                    }
                }
            }

            newObj.default = obj;
            return newObj;
        }
    }

    function _newArrowCheck(innerThis, boundThis) {
        if (innerThis !== boundThis) {
            throw new TypeError('Cannot instantiate an arrow function');
        }
    }

    function _objectDestructuringEmpty(obj) {
        if (obj == null) throw new TypeError('Cannot destructure undefined');
    }

    function _objectWithoutPropertiesLoose(source, excluded) {
        if (source == null) return {};
        var target = {};
        var sourceKeys = Object.keys(source);
        var key, i;

        for (i = 0; i < sourceKeys.length; i++) {
            key = sourceKeys[i];
            if (excluded.indexOf(key) >= 0) continue;
            target[key] = source[key];
        }

        return target;
    }

    function _objectWithoutProperties(source, excluded) {
        if (source == null) return {};

        var target = _objectWithoutPropertiesLoose(source, excluded);

        var key, i;

        if (Object.getOwnPropertySymbols) {
            var sourceSymbolKeys = Object.getOwnPropertySymbols(source);

            for (i = 0; i < sourceSymbolKeys.length; i++) {
                key = sourceSymbolKeys[i];
                if (excluded.indexOf(key) >= 0) continue;
                if (!Object.prototype.propertyIsEnumerable.call(source, key)) continue;
                target[key] = source[key];
            }
        }

        return target;
    }

    function _assertThisInitialized(self) {
        if (self === void 0) {
            throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        }

        return self;
    }

    function _possibleConstructorReturn(self, call) {
        if (call && (typeof call === 'object' || typeof call === 'function')) {
            return call;
        }

        return _assertThisInitialized(self);
    }

    function _superPropBase(object, property) {
        while (!Object.prototype.hasOwnProperty.call(object, property)) {
            object = _getPrototypeOf(object);
            if (object === null) break;
        }

        return object;
    }

    function _get(target, property, receiver) {
        if (typeof Reflect !== 'undefined' && Reflect.get) {
            _get = Reflect.get;
        } else {
            _get = function _get(target, property, receiver) {
                var base = _superPropBase(target, property);

                if (!base) return;
                var desc = Object.getOwnPropertyDescriptor(base, property);

                if (desc.get) {
                    return desc.get.call(receiver);
                }

                return desc.value;
            };
        }

        return _get(target, property, receiver || target);
    }

    function set(target, property, value, receiver) {
        if (typeof Reflect !== 'undefined' && Reflect.set) {
            set = Reflect.set;
        } else {
            set = function set(target, property, value, receiver) {
                var base = _superPropBase(target, property);

                var desc;

                if (base) {
                    desc = Object.getOwnPropertyDescriptor(base, property);

                    if (desc.set) {
                        desc.set.call(receiver, value);
                        return true;
                    } else if (!desc.writable) {
                        return false;
                    }
                }

                desc = Object.getOwnPropertyDescriptor(receiver, property);

                if (desc) {
                    if (!desc.writable) {
                        return false;
                    }

                    desc.value = value;
                    Object.defineProperty(receiver, property, desc);
                } else {
                    _defineProperty(receiver, property, value);
                }

                return true;
            };
        }

        return set(target, property, value, receiver);
    }

    function _set(target, property, value, receiver, isStrict) {
        var s = set(target, property, value, receiver || target);

        if (!s && isStrict) {
            throw new Error('failed to set property');
        }

        return value;
    }

    function _taggedTemplateLiteral(strings, raw) {
        if (!raw) {
            raw = strings.slice(0);
        }

        return Object.freeze(
            Object.defineProperties(strings, {
                raw: {
                    value: Object.freeze(raw),
                },
            })
        );
    }

    function _taggedTemplateLiteralLoose(strings, raw) {
        if (!raw) {
            raw = strings.slice(0);
        }

        strings.raw = raw;
        return strings;
    }

    function _temporalRef(val, name) {
        if (val === _temporalUndefined) {
            throw new ReferenceError(name + ' is not defined - temporal dead zone');
        } else {
            return val;
        }
    }

    function _readOnlyError(name) {
        throw new Error('"' + name + '" is read-only');
    }

    function _classNameTDZError(name) {
        throw new Error('Class "' + name + '" cannot be referenced in computed property keys.');
    }

    var _temporalUndefined = {};

    function _slicedToArray(arr, i) {
        return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest();
    }

    function _slicedToArrayLoose(arr, i) {
        return _arrayWithHoles(arr) || _iterableToArrayLimitLoose(arr, i) || _nonIterableRest();
    }

    function _toArray(arr) {
        return _arrayWithHoles(arr) || _iterableToArray(arr) || _nonIterableRest();
    }

    function _toConsumableArray(arr) {
        return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread();
    }

    function _arrayWithoutHoles(arr) {
        if (Array.isArray(arr)) {
            for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) arr2[i] = arr[i];

            return arr2;
        }
    }

    function _arrayWithHoles(arr) {
        if (Array.isArray(arr)) return arr;
    }

    function _iterableToArray(iter) {
        if (
            Symbol.iterator in Object(iter) ||
            Object.prototype.toString.call(iter) === '[object Arguments]'
        )
            return Array.from(iter);
    }

    function _iterableToArrayLimit(arr, i) {
        var _arr = [];
        var _n = true;
        var _d = false;
        var _e = undefined;

        try {
            for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) {
                _arr.push(_s.value);

                if (i && _arr.length === i) break;
            }
        } catch (err) {
            _d = true;
            _e = err;
        } finally {
            try {
                if (!_n && _i['return'] != null) _i['return']();
            } finally {
                if (_d) throw _e;
            }
        }

        return _arr;
    }

    function _iterableToArrayLimitLoose(arr, i) {
        var _arr = [];

        for (var _iterator = arr[Symbol.iterator](), _step; !(_step = _iterator.next()).done; ) {
            _arr.push(_step.value);

            if (i && _arr.length === i) break;
        }

        return _arr;
    }

    function _nonIterableSpread() {
        throw new TypeError('Invalid attempt to spread non-iterable instance');
    }

    function _nonIterableRest() {
        throw new TypeError('Invalid attempt to destructure non-iterable instance');
    }

    function _skipFirstGeneratorNext(fn) {
        return function() {
            var it = fn.apply(this, arguments);
            it.next();
            return it;
        };
    }

    function _toPrimitive(input, hint) {
        if (typeof input !== 'object' || input === null) return input;
        var prim = input[Symbol.toPrimitive];

        if (prim !== undefined) {
            var res = prim.call(input, hint || 'default');
            if (typeof res !== 'object') return res;
            throw new TypeError('@@toPrimitive must return a primitive value.');
        }

        return (hint === 'string' ? String : Number)(input);
    }

    function _toPropertyKey(arg) {
        var key = _toPrimitive(arg, 'string');

        return typeof key === 'symbol' ? key : String(key);
    }

    function _initializerWarningHelper(descriptor, context) {
        throw new Error(
            'Decorating class property failed. Please ensure that ' +
                'proposal-class-properties is enabled and set to use loose mode. ' +
                'To use proposal-class-properties in spec mode with decorators, wait for ' +
                'the next major version of decorators in stage 2.'
        );
    }

    function _initializerDefineProperty(target, property, descriptor, context) {
        if (!descriptor) return;
        Object.defineProperty(target, property, {
            enumerable: descriptor.enumerable,
            configurable: descriptor.configurable,
            writable: descriptor.writable,
            value: descriptor.initializer ? descriptor.initializer.call(context) : void 0,
        });
    }

    function _applyDecoratedDescriptor(target, property, decorators, descriptor, context) {
        var desc = {};
        Object.keys(descriptor).forEach(function(key) {
            desc[key] = descriptor[key];
        });
        desc.enumerable = !!desc.enumerable;
        desc.configurable = !!desc.configurable;

        if ('value' in desc || desc.initializer) {
            desc.writable = true;
        }

        desc = decorators
            .slice()
            .reverse()
            .reduce(function(desc, decorator) {
                return decorator(target, property, desc) || desc;
            }, desc);

        if (context && desc.initializer !== void 0) {
            desc.value = desc.initializer ? desc.initializer.call(context) : void 0;
            desc.initializer = undefined;
        }

        if (desc.initializer === void 0) {
            Object.defineProperty(target, property, desc);
            desc = null;
        }

        return desc;
    }

    var id = 0;

    function _classPrivateFieldLooseKey(name) {
        return '__private_' + id++ + '_' + name;
    }

    function _classPrivateFieldLooseBase(receiver, privateKey) {
        if (!Object.prototype.hasOwnProperty.call(receiver, privateKey)) {
            throw new TypeError('attempted to use private field on non-instance');
        }

        return receiver;
    }

    function _classPrivateFieldGet(receiver, privateMap) {
        if (!privateMap.has(receiver)) {
            throw new TypeError('attempted to get private field on non-instance');
        }

        var descriptor = privateMap.get(receiver);

        if (descriptor.get) {
            return descriptor.get.call(receiver);
        }

        return descriptor.value;
    }

    function _classPrivateFieldSet(receiver, privateMap, value) {
        if (!privateMap.has(receiver)) {
            throw new TypeError('attempted to set private field on non-instance');
        }

        var descriptor = privateMap.get(receiver);

        if (descriptor.set) {
            descriptor.set.call(receiver, value);
        } else {
            if (!descriptor.writable) {
                throw new TypeError('attempted to set read only private field');
            }

            descriptor.value = value;
        }

        return value;
    }

    function _classStaticPrivateFieldSpecGet(receiver, classConstructor, descriptor) {
        if (receiver !== classConstructor) {
            throw new TypeError('Private static access of wrong provenance');
        }

        return descriptor.value;
    }

    function _classStaticPrivateFieldSpecSet(receiver, classConstructor, descriptor, value) {
        if (receiver !== classConstructor) {
            throw new TypeError('Private static access of wrong provenance');
        }

        if (!descriptor.writable) {
            throw new TypeError('attempted to set read only private field');
        }

        descriptor.value = value;
        return value;
    }

    function _classStaticPrivateMethodGet(receiver, classConstructor, method) {
        if (receiver !== classConstructor) {
            throw new TypeError('Private static access of wrong provenance');
        }

        return method;
    }

    function _classStaticPrivateMethodSet() {
        throw new TypeError('attempted to set read only static private field');
    }

    function _decorate(decorators, factory, superClass, mixins) {
        var api = _getDecoratorsApi();

        if (mixins) {
            for (var i = 0; i < mixins.length; i++) {
                api = mixins[i](api);
            }
        }

        var r = factory(function initialize(O) {
            api.initializeInstanceElements(O, decorated.elements);
        }, superClass);
        var decorated = api.decorateClass(
            _coalesceClassElements(r.d.map(_createElementDescriptor)),
            decorators
        );
        api.initializeClassElements(r.F, decorated.elements);
        return api.runClassFinishers(r.F, decorated.finishers);
    }

    function _getDecoratorsApi() {
        _getDecoratorsApi = function() {
            return api;
        };

        var api = {
            elementsDefinitionOrder: [['method'], ['field']],
            initializeInstanceElements: function(O, elements) {
                ['method', 'field'].forEach(function(kind) {
                    elements.forEach(function(element) {
                        if (element.kind === kind && element.placement === 'own') {
                            this.defineClassElement(O, element);
                        }
                    }, this);
                }, this);
            },
            initializeClassElements: function(F, elements) {
                var proto = F.prototype;
                ['method', 'field'].forEach(function(kind) {
                    elements.forEach(function(element) {
                        var placement = element.placement;

                        if (
                            element.kind === kind &&
                            (placement === 'static' || placement === 'prototype')
                        ) {
                            var receiver = placement === 'static' ? F : proto;
                            this.defineClassElement(receiver, element);
                        }
                    }, this);
                }, this);
            },
            defineClassElement: function(receiver, element) {
                var descriptor = element.descriptor;

                if (element.kind === 'field') {
                    var initializer = element.initializer;
                    descriptor = {
                        enumerable: descriptor.enumerable,
                        writable: descriptor.writable,
                        configurable: descriptor.configurable,
                        value: initializer === void 0 ? void 0 : initializer.call(receiver),
                    };
                }

                Object.defineProperty(receiver, element.key, descriptor);
            },
            decorateClass: function(elements, decorators) {
                var newElements = [];
                var finishers = [];
                var placements = {
                    static: [],
                    prototype: [],
                    own: [],
                };
                elements.forEach(function(element) {
                    this.addElementPlacement(element, placements);
                }, this);
                elements.forEach(function(element) {
                    if (!_hasDecorators(element)) return newElements.push(element);
                    var elementFinishersExtras = this.decorateElement(element, placements);
                    newElements.push(elementFinishersExtras.element);
                    newElements.push.apply(newElements, elementFinishersExtras.extras);
                    finishers.push.apply(finishers, elementFinishersExtras.finishers);
                }, this);

                if (!decorators) {
                    return {
                        elements: newElements,
                        finishers: finishers,
                    };
                }

                var result = this.decorateConstructor(newElements, decorators);
                finishers.push.apply(finishers, result.finishers);
                result.finishers = finishers;
                return result;
            },
            addElementPlacement: function(element, placements, silent) {
                var keys = placements[element.placement];

                if (!silent && keys.indexOf(element.key) !== -1) {
                    throw new TypeError('Duplicated element (' + element.key + ')');
                }

                keys.push(element.key);
            },
            decorateElement: function(element, placements) {
                var extras = [];
                var finishers = [];

                for (var decorators = element.decorators, i = decorators.length - 1; i >= 0; i--) {
                    var keys = placements[element.placement];
                    keys.splice(keys.indexOf(element.key), 1);
                    var elementObject = this.fromElementDescriptor(element);
                    var elementFinisherExtras = this.toElementFinisherExtras(
                        (0, decorators[i])(elementObject) || elementObject
                    );
                    element = elementFinisherExtras.element;
                    this.addElementPlacement(element, placements);

                    if (elementFinisherExtras.finisher) {
                        finishers.push(elementFinisherExtras.finisher);
                    }

                    var newExtras = elementFinisherExtras.extras;

                    if (newExtras) {
                        for (var j = 0; j < newExtras.length; j++) {
                            this.addElementPlacement(newExtras[j], placements);
                        }

                        extras.push.apply(extras, newExtras);
                    }
                }

                return {
                    element: element,
                    finishers: finishers,
                    extras: extras,
                };
            },
            decorateConstructor: function(elements, decorators) {
                var finishers = [];

                for (var i = decorators.length - 1; i >= 0; i--) {
                    var obj = this.fromClassDescriptor(elements);
                    var elementsAndFinisher = this.toClassDescriptor(
                        (0, decorators[i])(obj) || obj
                    );

                    if (elementsAndFinisher.finisher !== undefined) {
                        finishers.push(elementsAndFinisher.finisher);
                    }

                    if (elementsAndFinisher.elements !== undefined) {
                        elements = elementsAndFinisher.elements;

                        for (var j = 0; j < elements.length - 1; j++) {
                            for (var k = j + 1; k < elements.length; k++) {
                                if (
                                    elements[j].key === elements[k].key &&
                                    elements[j].placement === elements[k].placement
                                ) {
                                    throw new TypeError(
                                        'Duplicated element (' + elements[j].key + ')'
                                    );
                                }
                            }
                        }
                    }
                }

                return {
                    elements: elements,
                    finishers: finishers,
                };
            },
            fromElementDescriptor: function(element) {
                var obj = {
                    kind: element.kind,
                    key: element.key,
                    placement: element.placement,
                    descriptor: element.descriptor,
                };
                var desc = {
                    value: 'Descriptor',
                    configurable: true,
                };
                Object.defineProperty(obj, Symbol.toStringTag, desc);
                if (element.kind === 'field') obj.initializer = element.initializer;
                return obj;
            },
            toElementDescriptors: function(elementObjects) {
                if (elementObjects === undefined) return;
                return _toArray(elementObjects).map(function(elementObject) {
                    var element = this.toElementDescriptor(elementObject);
                    this.disallowProperty(elementObject, 'finisher', 'An element descriptor');
                    this.disallowProperty(elementObject, 'extras', 'An element descriptor');
                    return element;
                }, this);
            },
            toElementDescriptor: function(elementObject) {
                var kind = String(elementObject.kind);

                if (kind !== 'method' && kind !== 'field') {
                    throw new TypeError(
                        'An element descriptor\'s .kind property must be either "method" or' +
                            ' "field", but a decorator created an element descriptor with' +
                            ' .kind "' +
                            kind +
                            '"'
                    );
                }

                var key = _toPropertyKey(elementObject.key);

                var placement = String(elementObject.placement);

                if (placement !== 'static' && placement !== 'prototype' && placement !== 'own') {
                    throw new TypeError(
                        'An element descriptor\'s .placement property must be one of "static",' +
                            ' "prototype" or "own", but a decorator created an element descriptor' +
                            ' with .placement "' +
                            placement +
                            '"'
                    );
                }

                var descriptor = elementObject.descriptor;
                this.disallowProperty(elementObject, 'elements', 'An element descriptor');
                var element = {
                    kind: kind,
                    key: key,
                    placement: placement,
                    descriptor: Object.assign({}, descriptor),
                };

                if (kind !== 'field') {
                    this.disallowProperty(elementObject, 'initializer', 'A method descriptor');
                } else {
                    this.disallowProperty(
                        descriptor,
                        'get',
                        'The property descriptor of a field descriptor'
                    );
                    this.disallowProperty(
                        descriptor,
                        'set',
                        'The property descriptor of a field descriptor'
                    );
                    this.disallowProperty(
                        descriptor,
                        'value',
                        'The property descriptor of a field descriptor'
                    );
                    element.initializer = elementObject.initializer;
                }

                return element;
            },
            toElementFinisherExtras: function(elementObject) {
                var element = this.toElementDescriptor(elementObject);

                var finisher = _optionalCallableProperty(elementObject, 'finisher');

                var extras = this.toElementDescriptors(elementObject.extras);
                return {
                    element: element,
                    finisher: finisher,
                    extras: extras,
                };
            },
            fromClassDescriptor: function(elements) {
                var obj = {
                    kind: 'class',
                    elements: elements.map(this.fromElementDescriptor, this),
                };
                var desc = {
                    value: 'Descriptor',
                    configurable: true,
                };
                Object.defineProperty(obj, Symbol.toStringTag, desc);
                return obj;
            },
            toClassDescriptor: function(obj) {
                var kind = String(obj.kind);

                if (kind !== 'class') {
                    throw new TypeError(
                        'A class descriptor\'s .kind property must be "class", but a decorator' +
                            ' created a class descriptor with .kind "' +
                            kind +
                            '"'
                    );
                }

                this.disallowProperty(obj, 'key', 'A class descriptor');
                this.disallowProperty(obj, 'placement', 'A class descriptor');
                this.disallowProperty(obj, 'descriptor', 'A class descriptor');
                this.disallowProperty(obj, 'initializer', 'A class descriptor');
                this.disallowProperty(obj, 'extras', 'A class descriptor');

                var finisher = _optionalCallableProperty(obj, 'finisher');

                var elements = this.toElementDescriptors(obj.elements);
                return {
                    elements: elements,
                    finisher: finisher,
                };
            },
            runClassFinishers: function(constructor, finishers) {
                for (var i = 0; i < finishers.length; i++) {
                    var newConstructor = (0, finishers[i])(constructor);

                    if (newConstructor !== undefined) {
                        if (typeof newConstructor !== 'function') {
                            throw new TypeError('Finishers must return a constructor.');
                        }

                        constructor = newConstructor;
                    }
                }

                return constructor;
            },
            disallowProperty: function(obj, name, objectType) {
                if (obj[name] !== undefined) {
                    throw new TypeError(objectType + " can't have a ." + name + ' property.');
                }
            },
        };
        return api;
    }

    function _createElementDescriptor(def) {
        var key = _toPropertyKey(def.key);

        var descriptor;

        if (def.kind === 'method') {
            descriptor = {
                value: def.value,
                writable: true,
                configurable: true,
                enumerable: false,
            };
        } else if (def.kind === 'get') {
            descriptor = {
                get: def.value,
                configurable: true,
                enumerable: false,
            };
        } else if (def.kind === 'set') {
            descriptor = {
                set: def.value,
                configurable: true,
                enumerable: false,
            };
        } else if (def.kind === 'field') {
            descriptor = {
                configurable: true,
                writable: true,
                enumerable: true,
            };
        }

        var element = {
            kind: def.kind === 'field' ? 'field' : 'method',
            key: key,
            placement: def.static ? 'static' : def.kind === 'field' ? 'own' : 'prototype',
            descriptor: descriptor,
        };
        if (def.decorators) element.decorators = def.decorators;
        if (def.kind === 'field') element.initializer = def.value;
        return element;
    }

    function _coalesceGetterSetter(element, other) {
        if (element.descriptor.get !== undefined) {
            other.descriptor.get = element.descriptor.get;
        } else {
            other.descriptor.set = element.descriptor.set;
        }
    }

    function _coalesceClassElements(elements) {
        var newElements = [];

        var isSameElement = function(other) {
            return (
                other.kind === 'method' &&
                other.key === element.key &&
                other.placement === element.placement
            );
        };

        for (var i = 0; i < elements.length; i++) {
            var element = elements[i];
            var other;

            if (element.kind === 'method' && (other = newElements.find(isSameElement))) {
                if (_isDataDescriptor(element.descriptor) || _isDataDescriptor(other.descriptor)) {
                    if (_hasDecorators(element) || _hasDecorators(other)) {
                        throw new ReferenceError(
                            'Duplicated methods (' + element.key + ") can't be decorated."
                        );
                    }

                    other.descriptor = element.descriptor;
                } else {
                    if (_hasDecorators(element)) {
                        if (_hasDecorators(other)) {
                            throw new ReferenceError(
                                "Decorators can't be placed on different accessors with for " +
                                    'the same property (' +
                                    element.key +
                                    ').'
                            );
                        }

                        other.decorators = element.decorators;
                    }

                    _coalesceGetterSetter(element, other);
                }
            } else {
                newElements.push(element);
            }
        }

        return newElements;
    }

    function _hasDecorators(element) {
        return element.decorators && element.decorators.length;
    }

    function _isDataDescriptor(desc) {
        return desc !== undefined && !(desc.value === undefined && desc.writable === undefined);
    }

    function _optionalCallableProperty(obj, name) {
        var value = obj[name];

        if (value !== undefined && typeof value !== 'function') {
            throw new TypeError("Expected '" + name + "' to be a function");
        }

        return value;
    }

    function _classPrivateMethodGet(receiver, privateSet, fn) {
        if (!privateSet.has(receiver)) {
            throw new TypeError('attempted to get private field on non-instance');
        }

        return fn;
    }

    function _classPrivateMethodSet() {
        throw new TypeError('attempted to reassign private method');
    }

    function _wrapRegExp(re, groups) {
        _wrapRegExp = function(re, groups) {
            return new BabelRegExp(re, groups);
        };

        var _RegExp = _wrapNativeSuper(RegExp);

        var _super = RegExp.prototype;

        var _groups = new WeakMap();

        function BabelRegExp(re, groups) {
            var _this = _RegExp.call(this, re);

            _groups.set(_this, groups);

            return _this;
        }

        _inherits(BabelRegExp, _RegExp);

        BabelRegExp.prototype.exec = function(str) {
            var result = _super.exec.call(this, str);

            if (result) result.groups = buildGroups(result, this);
            return result;
        };

        BabelRegExp.prototype[Symbol.replace] = function(str, substitution) {
            if (typeof substitution === 'string') {
                var groups = _groups.get(this);

                return _super[Symbol.replace].call(
                    this,
                    str,
                    substitution.replace(/\$<([^>]+)>/g, function(_, name) {
                        return '$' + groups[name];
                    })
                );
            } else if (typeof substitution === 'function') {
                var _this = this;

                return _super[Symbol.replace].call(this, str, function() {
                    var args = [];
                    args.push.apply(args, arguments);

                    if (typeof args[args.length - 1] !== 'object') {
                        args.push(buildGroups(args, _this));
                    }

                    return substitution.apply(this, args);
                });
            } else {
                return _super[Symbol.replace].call(this, str, substitution);
            }
        };

        function buildGroups(result, re) {
            var g = _groups.get(re);

            return Object.keys(g).reduce(function(groups, name) {
                groups[name] = result[g[name]];
                return groups;
            }, Object.create(null));
        }

        return _wrapRegExp.apply(this, arguments);
    }

    var MARKUP_RECT = ['x', 'y', 'left', 'top', 'right', 'bottom', 'width', 'height'];

    var toOptionalFraction = function toOptionalFraction(value) {
        return typeof value === 'string' && /%/.test(value) ? parseFloat(value) / 100 : value;
    };

    // adds default markup properties, clones markup
    var prepareMarkup = function prepareMarkup(markup) {
        var _markup = _slicedToArray(markup, 2),
            type = _markup[0],
            props = _markup[1];

        var rect = props.points
            ? {}
            : MARKUP_RECT.reduce(function(prev, curr) {
                  prev[curr] = toOptionalFraction(props[curr]);
                  return prev;
              }, {});

        return [
            type,
            Object.assign(
                {
                    zIndex: 0,
                },
                props,
                rect
            ),
        ];
    };

    var getImageSize = function getImageSize(file) {
        return new Promise(function(resolve, reject) {
            var imageElement = new Image();
            imageElement.src = URL.createObjectURL(file);

            // start testing size
            var measure = function measure() {
                var width = imageElement.naturalWidth;
                var height = imageElement.naturalHeight;
                var hasSize = width && height;
                if (!hasSize) return;

                URL.revokeObjectURL(imageElement.src);
                clearInterval(intervalId);
                resolve({ width: width, height: height });
            };

            imageElement.onerror = function(err) {
                URL.revokeObjectURL(imageElement.src);
                clearInterval(intervalId);
                reject(err);
            };

            var intervalId = setInterval(measure, 1);

            measure();
        });
    };

    /**
     * Polyfill Edge and IE when in Browser
     */
    if (typeof window !== 'undefined' && typeof window.document !== 'undefined') {
        if (!HTMLCanvasElement.prototype.toBlob) {
            Object.defineProperty(HTMLCanvasElement.prototype, 'toBlob', {
                value: function value(cb, type, quality) {
                    var canvas = this;
                    setTimeout(function() {
                        var dataURL = canvas.toDataURL(type, quality).split(',')[1];
                        var binStr = atob(dataURL);
                        var index = binStr.length;
                        var data = new Uint8Array(index);
                        while (index--) {
                            data[index] = binStr.charCodeAt(index);
                        }
                        cb(new Blob([data], { type: type || 'image/png' }));
                    });
                },
            });
        }
    }

    var isBrowser = typeof window !== 'undefined' && typeof window.document !== 'undefined';
    var isIOS = isBrowser && /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;

    /**
     * Image Transform Plugin
     */
    var plugin = function plugin(_ref) {
        var addFilter = _ref.addFilter,
            utils = _ref.utils;
        var Type = utils.Type,
            forin = utils.forin,
            getFileFromBlob = utils.getFileFromBlob,
            isFile = utils.isFile;

        /**
         * Helper functions
         */

        // valid transforms (in correct order)
        var TRANSFORM_LIST = ['crop', 'resize', 'filter', 'markup', 'output'];

        var createVariantCreator = function createVariantCreator(updateMetadata) {
            return function(transform, file, metadata) {
                return transform(file, updateMetadata ? updateMetadata(metadata) : metadata);
            };
        };

        var isDefaultCrop = function isDefaultCrop(crop) {
            return (
                crop.aspectRatio === null &&
                crop.rotation === 0 &&
                crop.zoom === 1 &&
                crop.center &&
                crop.center.x === 0.5 &&
                crop.center.y === 0.5 &&
                crop.flip &&
                crop.flip.horizontal === false &&
                crop.flip.vertical === false
            );
        };

        /**
         * Filters
         */
        addFilter('SHOULD_PREPARE_OUTPUT', function(shouldPrepareOutput, _ref2) {
            var query = _ref2.query;
            return new Promise(function(resolve) {
                // If is not async should prepare now
                resolve(!query('IS_ASYNC'));
            });
        });

        var shouldTransformFile = function shouldTransformFile(query, file, item) {
            return new Promise(function(resolve) {
                if (
                    !query('GET_ALLOW_IMAGE_TRANSFORM') ||
                    item.archived ||
                    !isFile(file) ||
                    !isImage(file)
                ) {
                    return resolve(false);
                }

                // if size can't be read this browser doesn't support image
                getImageSize(file)
                    .then(function() {
                        var fn = query('GET_IMAGE_TRANSFORM_IMAGE_FILTER');
                        if (fn) {
                            var filterResult = fn(file);
                            if (filterResult == null) {
                                // undefined or null
                                return handleRevert(true);
                            }
                            if (typeof filterResult === 'boolean') {
                                return resolve(filterResult);
                            }
                            if (typeof filterResult.then === 'function') {
                                return filterResult.then(resolve);
                            }
                        }

                        resolve(true);
                    })
                    .catch(function(err) {
                        resolve(false);
                    });
            });
        };

        addFilter('DID_CREATE_ITEM', function(item, _ref3) {
            var query = _ref3.query,
                dispatch = _ref3.dispatch;
            if (!query('GET_ALLOW_IMAGE_TRANSFORM')) return;

            item.extend('requestPrepare', function() {
                return new Promise(function(resolve, reject) {
                    dispatch(
                        'REQUEST_PREPARE_OUTPUT',
                        {
                            query: item.id,
                            item: item,
                            success: resolve,
                            failure: reject,
                        },

                        true
                    );
                });
            });
        });

        // subscribe to file transformations
        addFilter('PREPARE_OUTPUT', function(file, _ref4) {
            var query = _ref4.query,
                item = _ref4.item;
            return new Promise(function(resolve) {
                shouldTransformFile(query, file, item).then(function(shouldTransform) {
                    // no need to transform, exit
                    if (!shouldTransform) return resolve(file);

                    // get variants
                    var variants = [];

                    // add original file
                    if (query('GET_IMAGE_TRANSFORM_VARIANTS_INCLUDE_ORIGINAL')) {
                        variants.push(function() {
                            return new Promise(function(resolve) {
                                resolve({
                                    name: query('GET_IMAGE_TRANSFORM_VARIANTS_ORIGINAL_NAME'),
                                    file: file,
                                });
                            });
                        });
                    }

                    // add default output version if output default set to true or if no variants defined
                    if (query('GET_IMAGE_TRANSFORM_VARIANTS_INCLUDE_DEFAULT')) {
                        variants.push(function(transform, file, metadata) {
                            return new Promise(function(resolve) {
                                transform(file, metadata).then(function(file) {
                                    return resolve({
                                        name: query('GET_IMAGE_TRANSFORM_VARIANTS_DEFAULT_NAME'),

                                        file: file,
                                    });
                                });
                            });
                        });
                    }

                    // get other variants
                    var variantsDefinition = query('GET_IMAGE_TRANSFORM_VARIANTS') || {};
                    forin(variantsDefinition, function(key, fn) {
                        var createVariant = createVariantCreator(fn);
                        variants.push(function(transform, file, metadata) {
                            return new Promise(function(resolve) {
                                createVariant(transform, file, metadata).then(function(file) {
                                    return resolve({ name: key, file: file });
                                });
                            });
                        });
                    });

                    // output format (quality 0 => 100)
                    var qualityAsPercentage = query('GET_IMAGE_TRANSFORM_OUTPUT_QUALITY');
                    var qualityMode = query('GET_IMAGE_TRANSFORM_OUTPUT_QUALITY_MODE');
                    var quality = qualityAsPercentage === null ? null : qualityAsPercentage / 100;
                    var type = query('GET_IMAGE_TRANSFORM_OUTPUT_MIME_TYPE');
                    var clientTransforms =
                        query('GET_IMAGE_TRANSFORM_CLIENT_TRANSFORMS') || TRANSFORM_LIST;

                    // update transform metadata object
                    item.setMetadata(
                        'output',
                        {
                            type: type,
                            quality: quality,
                            client: clientTransforms,
                        },

                        true
                    );

                    // the function that is used to apply the file transformations
                    var transform = function transform(file, metadata) {
                        return new Promise(function(resolve, reject) {
                            var filteredMetadata = Object.assign({}, metadata);

                            Object.keys(filteredMetadata)
                                .filter(function(instruction) {
                                    return instruction !== 'exif';
                                })
                                .forEach(function(instruction) {
                                    // if not in list, remove from object, the instruction will be handled by the server
                                    if (clientTransforms.indexOf(instruction) === -1) {
                                        delete filteredMetadata[instruction];
                                    }
                                });
                            var resize = filteredMetadata.resize,
                                exif = filteredMetadata.exif,
                                output = filteredMetadata.output,
                                crop = filteredMetadata.crop,
                                filter = filteredMetadata.filter,
                                markup = filteredMetadata.markup;

                            var instructions = {
                                image: {
                                    orientation: exif ? exif.orientation : null,
                                },

                                output:
                                    output &&
                                    (output.type ||
                                        typeof output.quality === 'number' ||
                                        output.background)
                                        ? {
                                              type: output.type,
                                              quality:
                                                  typeof output.quality === 'number'
                                                      ? output.quality * 100
                                                      : null,
                                              background:
                                                  output.background ||
                                                  query(
                                                      'GET_IMAGE_TRANSFORM_CANVAS_BACKGROUND_COLOR'
                                                  ) ||
                                                  null,
                                          }
                                        : undefined,
                                size:
                                    resize && (resize.size.width || resize.size.height)
                                        ? Object.assign(
                                              {
                                                  mode: resize.mode,
                                                  upscale: resize.upscale,
                                              },
                                              resize.size
                                          )
                                        : undefined,
                                crop:
                                    crop && !isDefaultCrop(crop)
                                        ? Object.assign(
                                              {},

                                              crop
                                          )
                                        : undefined,
                                markup: markup && markup.length ? markup.map(prepareMarkup) : [],
                                filter: filter,
                            };

                            if (instructions.output) {
                                // determine if file type will change
                                var willChangeType = output.type
                                    ? // type set
                                      output.type !== file.type
                                    : // type not set
                                      false;

                                var canChangeQuality = /\/jpe?g$/.test(file.type);
                                var willChangeQuality =
                                    output.quality !== null
                                        ? // quality set
                                          canChangeQuality && qualityMode === 'always'
                                        : // quality not set
                                          false;

                                // determine if file data will be modified
                                var willModifyImageData = !!(
                                    instructions.size ||
                                    instructions.crop ||
                                    instructions.filter ||
                                    willChangeType ||
                                    willChangeQuality
                                );

                                // if we're not modifying the image data then we don't have to modify the output
                                if (!willModifyImageData) return resolve(file);
                            }

                            var options = {
                                beforeCreateBlob: query('GET_IMAGE_TRANSFORM_BEFORE_CREATE_BLOB'),
                                afterCreateBlob: query('GET_IMAGE_TRANSFORM_AFTER_CREATE_BLOB'),
                                canvasMemoryLimit: query('GET_IMAGE_TRANSFORM_CANVAS_MEMORY_LIMIT'),
                                stripImageHead: query(
                                    'GET_IMAGE_TRANSFORM_OUTPUT_STRIP_IMAGE_HEAD'
                                ),
                            };

                            transformImage(file, instructions, options)
                                .then(function(blob) {
                                    // set file object
                                    var out = getFileFromBlob(
                                        blob,
                                        // rename the original filename to match the mime type of the output image
                                        renameFileToMatchMimeType(
                                            file.name,
                                            getValidOutputMimeType(blob.type)
                                        )
                                    );

                                    resolve(out);
                                })
                                .catch(reject);
                        });
                    };

                    // start creating variants
                    var variantPromises = variants.map(function(create) {
                        return create(transform, file, item.getMetadata());
                    });

                    // wait for results
                    Promise.all(variantPromises).then(function(files) {
                        // if single file object in array, return the single file object else, return array of
                        resolve(
                            files.length === 1 && files[0].name === null
                                ? // return the File object
                                  files[0].file
                                : // return an array of files { name:'name', file:File }
                                  files
                        );
                    });
                });
            });
        });

        // Expose plugin options
        return {
            options: {
                allowImageTransform: [true, Type.BOOLEAN],

                // filter images to transform
                imageTransformImageFilter: [null, Type.FUNCTION],

                // null, 'image/jpeg', 'image/png'
                imageTransformOutputMimeType: [null, Type.STRING],

                // null, 0 - 100
                imageTransformOutputQuality: [null, Type.INT],

                // set to false to copy image exif data to output
                imageTransformOutputStripImageHead: [true, Type.BOOLEAN],

                // only apply transforms in this list
                imageTransformClientTransforms: [null, Type.ARRAY],

                // only apply output quality when a transform is required
                imageTransformOutputQualityMode: ['always', Type.STRING],
                // 'always'
                // 'optional'
                // 'mismatch' (future feature, only applied if quality differs from input)

                // get image transform variants
                imageTransformVariants: [null, Type.OBJECT],

                // should we post the default transformed file
                imageTransformVariantsIncludeDefault: [true, Type.BOOLEAN],

                // which name to prefix the default transformed file with
                imageTransformVariantsDefaultName: [null, Type.STRING],

                // should we post the original file
                imageTransformVariantsIncludeOriginal: [false, Type.BOOLEAN],

                // which name to prefix the original file with
                imageTransformVariantsOriginalName: ['original_', Type.STRING],

                // called before creating the blob, receives canvas, expects promise resolve with canvas
                imageTransformBeforeCreateBlob: [null, Type.FUNCTION],

                // expects promise resolved with blob
                imageTransformAfterCreateBlob: [null, Type.FUNCTION],

                // canvas memory limit
                imageTransformCanvasMemoryLimit: [
                    isBrowser && isIOS ? 4096 * 4096 : null,
                    Type.INT,
                ],

                // background image of the output canvas
                imageTransformCanvasBackgroundColor: [null, Type.STRING],
            },
        };
    };

    // fire pluginloaded event if running in browser, this allows registering the plugin when using async script tags
    if (isBrowser) {
        document.dispatchEvent(new CustomEvent('FilePond:pluginloaded', { detail: plugin }));
    }

    return plugin;
});

/*!
 * FilePondPluginImageCrop 2.0.6
 * Licensed under MIT, https://opensource.org/licenses/MIT/
 * Please visit https://pqina.nl/filepond/ for details.
 */

/* eslint-disable */

(function(global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined'
    ? (module.exports = factory())
    : typeof define === 'function' && define.amd
    ? define(factory)
    : ((global = global || self), (global.FilePondPluginImageCrop = factory()));
})(this, function() {
  'use strict';

  var isImage = function isImage(file) {
    return /^image/.test(file.type);
  };

  /**
   * Image Auto Crop Plugin
   */
  var plugin = function plugin(_ref) {
    var addFilter = _ref.addFilter,
      utils = _ref.utils;
    var Type = utils.Type,
      isFile = utils.isFile,
      getNumericAspectRatioFromString = utils.getNumericAspectRatioFromString;

    // tests if crop is allowed on this item
    var allowCrop = function allowCrop(item, query) {
      return !(!isImage(item.file) || !query('GET_ALLOW_IMAGE_CROP'));
    };

    var isObject = function isObject(value) {
      return typeof value === 'object';
    };

    var isNumber = function isNumber(value) {
      return typeof value === 'number';
    };

    var updateCrop = function updateCrop(item, obj) {
      return item.setMetadata(
        'crop',
        Object.assign({}, item.getMetadata('crop'), obj)
      );
    };

    // extend item methods
    addFilter('DID_CREATE_ITEM', function(item, _ref2) {
      var query = _ref2.query;

      item.extend('setImageCrop', function(crop) {
        if (!allowCrop(item, query) || !isObject(center)) return;
        item.setMetadata('crop', crop);
        return crop;
      });

      item.extend('setImageCropCenter', function(center) {
        if (!allowCrop(item, query) || !isObject(center)) return;
        return updateCrop(item, { center: center });
      });

      item.extend('setImageCropZoom', function(zoom) {
        if (!allowCrop(item, query) || !isNumber(zoom)) return;
        return updateCrop(item, { zoom: Math.max(1, zoom) });
      });

      item.extend('setImageCropRotation', function(rotation) {
        if (!allowCrop(item, query) || !isNumber(rotation)) return;
        return updateCrop(item, { rotation: rotation });
      });

      item.extend('setImageCropFlip', function(flip) {
        if (!allowCrop(item, query) || !isObject(flip)) return;
        return updateCrop(item, { flip: flip });
      });

      item.extend('setImageCropAspectRatio', function(newAspectRatio) {
        if (!allowCrop(item, query) || typeof newAspectRatio === 'undefined')
          return;

        var currentCrop = item.getMetadata('crop');

        var aspectRatio = getNumericAspectRatioFromString(newAspectRatio);

        var newCrop = {
          center: {
            x: 0.5,
            y: 0.5
          },

          flip: currentCrop
            ? Object.assign({}, currentCrop.flip)
            : {
                horizontal: false,
                vertical: false
              },

          rotation: 0,
          zoom: 1,
          aspectRatio: aspectRatio
        };

        item.setMetadata('crop', newCrop);

        return newCrop;
      });
    });

    // subscribe to file transformations
    addFilter('DID_LOAD_ITEM', function(item, _ref3) {
      var query = _ref3.query;
      return new Promise(function(resolve, reject) {
        // get file reference
        var file = item.file;

        // if this is not an image we do not have any business cropping it and we'll continue with the unaltered dataset
        if (!isFile(file) || !isImage(file) || !query('GET_ALLOW_IMAGE_CROP')) {
          return resolve(item);
        }

        // already has crop metadata set?
        var crop = item.getMetadata('crop');
        if (crop) {
          return resolve(item);
        }

        // get the required aspect ratio and exit if it's not set
        var humanAspectRatio = query('GET_IMAGE_CROP_ASPECT_RATIO');

        // set default crop rectangle
        item.setMetadata('crop', {
          center: {
            x: 0.5,
            y: 0.5
          },

          flip: {
            horizontal: false,
            vertical: false
          },

          rotation: 0,
          zoom: 1,
          aspectRatio: humanAspectRatio
            ? getNumericAspectRatioFromString(humanAspectRatio)
            : null
        });

        // we done!
        resolve(item);
      });
    });

    // Expose plugin options
    return {
      options: {
        // enable or disable image cropping
        allowImageCrop: [true, Type.BOOLEAN],

        // the aspect ratio of the crop ('1:1', '16:9', etc)
        imageCropAspectRatio: [null, Type.STRING]
      }
    };
  };

  // fire pluginloaded event if running in browser, this allows registering the plugin when using async script tags
  var isBrowser =
    typeof window !== 'undefined' && typeof window.document !== 'undefined';
  if (isBrowser) {
    document.dispatchEvent(
      new CustomEvent('FilePond:pluginloaded', { detail: plugin })
    );
  }

  return plugin;
});

/*!
 * FilePondPluginImageEdit 1.6.3
 * Licensed under MIT, https://opensource.org/licenses/MIT/
 * Please visit https://pqina.nl/filepond/ for details.
 */

/* eslint-disable */

(function(global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined'
    ? (module.exports = factory())
    : typeof define === 'function' && define.amd
    ? define(factory)
    : ((global = global || self), (global.FilePondPluginImageEdit = factory()));
})(this, function() {
  'use strict';

  var isPreviewableImage = function isPreviewableImage(file) {
    return /^image/.test(file.type);
  };

  /**
   * Image Edit Proxy Plugin
   */
  var plugin = function plugin(_) {
    var addFilter = _.addFilter,
      utils = _.utils,
      views = _.views;
    var Type = utils.Type,
      createRoute = utils.createRoute,
      _utils$createItemAPI = utils.createItemAPI,
      createItemAPI =
        _utils$createItemAPI === void 0
          ? function(item) {
              return item;
            }
          : _utils$createItemAPI;
    var fileActionButton = views.fileActionButton;

    addFilter('SHOULD_REMOVE_ON_REVERT', function(shouldRemove, _ref) {
      var item = _ref.item,
        query = _ref.query;
      return new Promise(function(resolve) {
        var file = item.file;

        // if this file is editable it shouldn't be removed immidiately even when instant uploading
        var canEdit =
          query('GET_ALLOW_IMAGE_EDIT') &&
          query('GET_IMAGE_EDIT_ALLOW_EDIT') &&
          isPreviewableImage(file);

        // if the file cannot be edited it should be removed on revert
        resolve(!canEdit);
      });
    });

    // open editor when loading a new item
    addFilter('DID_LOAD_ITEM', function(item, _ref2) {
      var query = _ref2.query,
        dispatch = _ref2.dispatch;
      return new Promise(function(resolve, reject) {
        // if is temp or local file
        if (item.origin > 1) {
          resolve(item);
          return;
        }

        // get file reference
        var file = item.file;
        if (
          !query('GET_ALLOW_IMAGE_EDIT') ||
          !query('GET_IMAGE_EDIT_INSTANT_EDIT')
        ) {
          resolve(item);
          return;
        }

        // exit if this is not an image
        if (!isPreviewableImage(file)) {
          resolve(item);
          return;
        }

        var createEditorResponseHandler = function createEditorResponseHandler(
          item,
          resolve,
          reject
        ) {
          return function(userDidConfirm) {
            // remove item
            editRequestQueue.shift();

            // handle item
            if (userDidConfirm) {
              resolve(item);
            } else {
              reject(item);
            }

            // TODO: Fix, should not be needed to kick the internal loop in case no processes are running
            dispatch('KICK');

            // handle next item!
            requestEdit();
          };
        };

        var requestEdit = function requestEdit() {
          if (!editRequestQueue.length) return;
          var _editRequestQueue$ = editRequestQueue[0],
            item = _editRequestQueue$.item,
            resolve = _editRequestQueue$.resolve,
            reject = _editRequestQueue$.reject;

          dispatch('EDIT_ITEM', {
            id: item.id,
            handleEditorResponse: createEditorResponseHandler(
              item,
              resolve,
              reject
            )
          });
        };

        queueEditRequest({ item: item, resolve: resolve, reject: reject });

        if (editRequestQueue.length === 1) {
          requestEdit();
        }
      });
    });

    // extend item methods
    addFilter('DID_CREATE_ITEM', function(item, _ref3) {
      var query = _ref3.query,
        dispatch = _ref3.dispatch;
      item.extend('edit', function() {
        dispatch('EDIT_ITEM', { id: item.id });
      });
    });

    var editRequestQueue = [];
    var queueEditRequest = function queueEditRequest(editRequest) {
      editRequestQueue.push(editRequest);
      return editRequest;
    };

    // called for each view that is created right after the 'create' method
    addFilter('CREATE_VIEW', function(viewAPI) {
      // get reference to created view
      var is = viewAPI.is,
        view = viewAPI.view,
        query = viewAPI.query;

      if (!query('GET_ALLOW_IMAGE_EDIT')) return;

      var canShowImagePreview = query('GET_ALLOW_IMAGE_PREVIEW');

      // only run for either the file or the file info panel
      var shouldExtendView =
        (is('file-info') && !canShowImagePreview) ||
        (is('file') && canShowImagePreview);

      if (!shouldExtendView) return;

      // no editor defined, then exit
      var editor = query('GET_IMAGE_EDIT_EDITOR');
      if (!editor) return;

      // set default FilePond options and add bridge once
      if (!editor.filepondCallbackBridge) {
        editor.outputData = true;
        editor.outputFile = false;
        editor.filepondCallbackBridge = {
          onconfirm: editor.onconfirm || function() {},
          oncancel: editor.oncancel || function() {}
        };
      }

      // opens the editor, if it does not already exist, it creates the editor
      var openEditor = function openEditor(_ref4) {
        var root = _ref4.root,
          props = _ref4.props,
          action = _ref4.action;
        var id = props.id;
        var handleEditorResponse = action.handleEditorResponse;

        // update editor props that could have changed
        editor.cropAspectRatio =
          root.query('GET_IMAGE_CROP_ASPECT_RATIO') || editor.cropAspectRatio;
        editor.outputCanvasBackgroundColor =
          root.query('GET_IMAGE_TRANSFORM_CANVAS_BACKGROUND_COLOR') ||
          editor.outputCanvasBackgroundColor;

        // get item
        var item = root.query('GET_ITEM', id);
        if (!item) return;

        // file to open
        var file = item.file;

        // crop data to pass to editor
        var crop = item.getMetadata('crop');
        var cropDefault = {
          center: {
            x: 0.5,
            y: 0.5
          },

          flip: {
            horizontal: false,
            vertical: false
          },

          zoom: 1,
          rotation: 0,
          aspectRatio: null
        };

        // size data to pass to editor
        var resize = item.getMetadata('resize');

        // filter and color data to pass to editor
        var filter = item.getMetadata('filter') || null;
        var filters = item.getMetadata('filters') || null;
        var colors = item.getMetadata('colors') || null;
        var markup = item.getMetadata('markup') || null;

        // build parameters object
        var imageParameters = {
          crop: crop || cropDefault,
          size: resize
            ? {
                upscale: resize.upscale,
                mode: resize.mode,
                width: resize.size.width,
                height: resize.size.height
              }
            : null,
          filter: filters
            ? filters.id || filters.matrix
            : root.query('GET_ALLOW_IMAGE_FILTER') &&
              root.query('GET_IMAGE_FILTER_COLOR_MATRIX') &&
              !colors
            ? filter
            : null,
          color: colors,
          markup: markup
        };

        editor.onconfirm = function(_ref5) {
          var data = _ref5.data;
          var crop = data.crop,
            size = data.size,
            filter = data.filter,
            color = data.color,
            colorMatrix = data.colorMatrix,
            markup = data.markup;

          // create new metadata object
          var metadata = {};

          // append crop data
          if (crop) {
            metadata.crop = crop;
          }

          // append size data
          if (size) {
            var initialSize = (item.getMetadata('resize') || {}).size;
            var targetSize = {
              width: size.width,
              height: size.height
            };

            if (!(targetSize.width && targetSize.height) && initialSize) {
              targetSize.width = initialSize.width;
              targetSize.height = initialSize.height;
            }

            if (targetSize.width || targetSize.height) {
              metadata.resize = {
                upscale: size.upscale,
                mode: size.mode,
                size: targetSize
              };
            }
          }

          if (markup) {
            metadata.markup = markup;
          }

          // set filters and colors so we can restore them when re-editing the image
          metadata.colors = color;
          metadata.filters = filter;

          // set merged color matrix to use in preview plugin
          metadata.filter = colorMatrix;

          // update crop metadata
          item.setMetadata(metadata);

          // call
          editor.filepondCallbackBridge.onconfirm(data, createItemAPI(item));

          // used in instant edit mode
          if (!handleEditorResponse) return;
          editor.onclose = function() {
            handleEditorResponse(true);
            editor.onclose = null;
          };
        };

        editor.oncancel = function() {
          // call
          editor.filepondCallbackBridge.oncancel(createItemAPI(item));

          // used in instant edit mode
          if (!handleEditorResponse) return;
          editor.onclose = function() {
            handleEditorResponse(false);
            editor.onclose = null;
          };
        };

        editor.open(file, imageParameters);
      };

      /**
       * Image Preview related
       */

      // create the image edit plugin, but only do so if the item is an image
      var didLoadItem = function didLoadItem(_ref6) {
        var root = _ref6.root,
          props = _ref6.props;

        if (!query('GET_IMAGE_EDIT_ALLOW_EDIT')) return;
        var id = props.id;

        // try to access item
        var item = query('GET_ITEM', id);
        if (!item) return;

        // get the file object
        var file = item.file;

        // exit if this is not an image
        if (!isPreviewableImage(file)) return;

        // handle interactions
        root.ref.handleEdit = function(e) {
          e.stopPropagation();
          root.dispatch('EDIT_ITEM', { id: id });
        };

        if (canShowImagePreview) {
          // add edit button to preview
          var buttonView = view.createChildView(fileActionButton, {
            label: 'edit',
            icon: query('GET_IMAGE_EDIT_ICON_EDIT'),
            opacity: 0
          });

          // edit item classname
          buttonView.element.classList.add('filepond--action-edit-item');
          buttonView.element.dataset.align = query(
            'GET_STYLE_IMAGE_EDIT_BUTTON_EDIT_ITEM_POSITION'
          );
          buttonView.on('click', root.ref.handleEdit);

          root.ref.buttonEditItem = view.appendChildView(buttonView);
        } else {
          // view is file info
          var filenameElement = view.element.querySelector(
            '.filepond--file-info-main'
          );
          var editButton = document.createElement('button');
          editButton.className = 'filepond--action-edit-item-alt';
          editButton.innerHTML =
            query('GET_IMAGE_EDIT_ICON_EDIT') + '<span>edit</span>';
          editButton.addEventListener('click', root.ref.handleEdit);
          filenameElement.appendChild(editButton);

          root.ref.editButton = editButton;
        }
      };

      view.registerDestroyer(function(_ref7) {
        var root = _ref7.root;
        if (root.ref.buttonEditItem) {
          root.ref.buttonEditItem.off('click', root.ref.handleEdit);
        }
        if (root.ref.editButton) {
          root.ref.editButton.removeEventListener('click', root.ref.handleEdit);
        }
      });

      var routes = {
        EDIT_ITEM: openEditor,
        DID_LOAD_ITEM: didLoadItem
      };

      if (canShowImagePreview) {
        // view is file
        var didPreviewUpdate = function didPreviewUpdate(_ref8) {
          var root = _ref8.root;
          if (!root.ref.buttonEditItem) return;
          root.ref.buttonEditItem.opacity = 1;
        };

        routes.DID_IMAGE_PREVIEW_SHOW = didPreviewUpdate;
      } else {
      }

      // start writing
      view.registerWriter(createRoute(routes));
    });

    // Expose plugin options
    return {
      options: {
        // enable or disable image editing
        allowImageEdit: [true, Type.BOOLEAN],

        // location of processing button
        styleImageEditButtonEditItemPosition: ['bottom center', Type.STRING],

        // open editor when image is dropped
        imageEditInstantEdit: [false, Type.BOOLEAN],

        // allow editing
        imageEditAllowEdit: [true, Type.BOOLEAN],

        // the icon to use for the edit button
        imageEditIconEdit: [
          '<svg width="26" height="26" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path d="M8.5 17h1.586l7-7L15.5 8.414l-7 7V17zm-1.707-2.707l8-8a1 1 0 0 1 1.414 0l3 3a1 1 0 0 1 0 1.414l-8 8A1 1 0 0 1 10.5 19h-3a1 1 0 0 1-1-1v-3a1 1 0 0 1 .293-.707z" fill="currentColor" fill-rule="nonzero"/></svg>',
          Type.STRING
        ],

        // editor object
        imageEditEditor: [null, Type.OBJECT]
      }
    };
  };

  // fire pluginloaded event if running in browser, this allows registering the plugin when using async script tags
  var isBrowser =
    typeof window !== 'undefined' && typeof window.document !== 'undefined';
  if (isBrowser) {
    document.dispatchEvent(
      new CustomEvent('FilePond:pluginloaded', { detail: plugin })
    );
  }

  return plugin;
});

/*!
 * FilePond 4.28.2
 * Licensed under MIT, https://opensource.org/licenses/MIT/
 * Please visit https://pqina.nl/filepond/ for details.
 */

/* eslint-disable */

!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?t(exports):"function"==typeof define&&define.amd?define(["exports"],t):t((e=e||self).FilePond={})}(this,function(e){"use strict";var t=function(e,t){for(var n in e)e.hasOwnProperty(n)&&t(n,e[n])},n=function(e){var n={};return t(e,function(t){!function(e,t,n){"function"!=typeof n?Object.defineProperty(e,t,Object.assign({},n)):e[t]=n}(n,t,e[t])}),n},r=function(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null;if(null===n)return e.getAttribute(t)||e.hasAttribute(t);e.setAttribute(t,n)},o=["svg","path"],i=function(e){return o.includes(e)},a=function(e,n){var o=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};"object"==typeof n&&(o=n,n=null);var a=i(e)?document.createElementNS("http://www.w3.org/2000/svg",e):document.createElement(e);return n&&(i(e)?r(a,"class",n):a.className=n),t(o,function(e,t){r(a,e,t)}),a},u=function(e,t){return function(e,n){return void 0!==n?t.splice(n,0,e):t.push(e),e}},s=function(e,t){return function(n){return t.splice(t.indexOf(n),1),n.element.parentNode&&e.removeChild(n.element),n}},l="undefined"!=typeof window&&void 0!==window.document,c=function(){return l},f="children"in(c()?a("svg"):{})?function(e){return e.children.length}:function(e){return e.childNodes.length},d=function(e,t,n,r){var o=n[0]||e.left,i=n[1]||e.top,a=o+e.width,u=i+e.height*(r[1]||1),s={element:Object.assign({},e),inner:{left:e.left,top:e.top,right:e.right,bottom:e.bottom},outer:{left:o,top:i,right:a,bottom:u}};return t.filter(function(e){return!e.isRectIgnored()}).map(function(e){return e.rect}).forEach(function(e){p(s.inner,Object.assign({},e.inner)),p(s.outer,Object.assign({},e.outer))}),E(s.inner),s.outer.bottom+=s.element.marginBottom,s.outer.right+=s.element.marginRight,E(s.outer),s},p=function(e,t){t.top+=e.top,t.right+=e.left,t.bottom+=e.top,t.left+=e.left,t.bottom>e.bottom&&(e.bottom=t.bottom),t.right>e.right&&(e.right=t.right)},E=function(e){e.width=e.right-e.left,e.height=e.bottom-e.top},_=function(e){return"number"==typeof e},T=function(e){return e<.5?2*e*e:(4-2*e)*e-1},I={spring:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},t=e.stiffness,r=void 0===t?.5:t,o=e.damping,i=void 0===o?.75:o,a=e.mass,u=void 0===a?10:a,s=null,l=null,c=0,f=!1,d=n({interpolate:function(e,t){if(!f){if(!_(s)||!_(l))return f=!0,void(c=0);(function(e,t,n){var r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:.001;return Math.abs(e-t)<r&&Math.abs(n)<r})(l+=c+=-(l-s)*r/u,s,c*=i)||t?(l=s,c=0,f=!0,d.onupdate(l),d.oncomplete(l)):d.onupdate(l)}},target:{set:function(e){if(_(e)&&!_(l)&&(l=e),null===s&&(s=e,l=e),l===(s=e)||void 0===s)return f=!0,c=0,d.onupdate(l),void d.oncomplete(l);f=!1},get:function(){return s}},resting:{get:function(){return f}},onupdate:function(e){},oncomplete:function(e){}});return d},tween:function(){var e,t,r=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},o=r.duration,i=void 0===o?500:o,a=r.easing,u=void 0===a?T:a,s=r.delay,l=void 0===s?0:s,c=null,f=!0,d=!1,p=null,E=n({interpolate:function(n,r){f||null===p||(null===c&&(c=n),n-c<l||((e=n-c-l)>=i||r?(e=1,t=d?0:1,E.onupdate(t*p),E.oncomplete(t*p),f=!0):(t=e/i,E.onupdate((e>=0?u(d?1-t:t):0)*p))))},target:{get:function(){return d?0:p},set:function(e){if(null===p)return p=e,E.onupdate(e),void E.oncomplete(e);e<p?(p=1,d=!0):(d=!1,p=e),f=!1,c=null}},resting:{get:function(){return f}},onupdate:function(e){},oncomplete:function(e){}});return E}},v=function(e,t,n){var r=e[t]&&"object"==typeof e[t][n]?e[t][n]:e[t]||e,o="string"==typeof r?r:r.type,i="object"==typeof r?Object.assign({},r):{};return I[o]?I[o](i):null},m=function(e,t,n){var r=arguments.length>3&&void 0!==arguments[3]&&arguments[3];(t=Array.isArray(t)?t:[t]).forEach(function(t){e.forEach(function(e){var o=e,i=function(){return n[e]},a=function(t){return n[e]=t};"object"==typeof e&&(o=e.key,i=e.getter||i,a=e.setter||a),t[o]&&!r||(t[o]={get:i,set:a})})})},h=function(e){return null!=e},g={opacity:1,scaleX:1,scaleY:1,translateX:0,translateY:0,rotateX:0,rotateY:0,rotateZ:0,originX:0,originY:0},R=function(e,t){if(Object.keys(e).length!==Object.keys(t).length)return!0;for(var n in t)if(t[n]!==e[n])return!0;return!1},O=function(e,t){var n=t.opacity,r=t.perspective,o=t.translateX,i=t.translateY,a=t.scaleX,u=t.scaleY,s=t.rotateX,l=t.rotateY,c=t.rotateZ,f=t.originX,d=t.originY,p=t.width,E=t.height,_="",T="";(h(f)||h(d))&&(T+="transform-origin: "+(f||0)+"px "+(d||0)+"px;"),h(r)&&(_+="perspective("+r+"px) "),(h(o)||h(i))&&(_+="translate3d("+(o||0)+"px, "+(i||0)+"px, 0) "),(h(a)||h(u))&&(_+="scale3d("+(h(a)?a:1)+", "+(h(u)?u:1)+", 1) "),h(c)&&(_+="rotateZ("+c+"rad) "),h(s)&&(_+="rotateX("+s+"rad) "),h(l)&&(_+="rotateY("+l+"rad) "),_.length&&(T+="transform:"+_+";"),h(n)&&(T+="opacity:"+n+";",0===n&&(T+="visibility:hidden;"),n<1&&(T+="pointer-events:none;")),h(E)&&(T+="height:"+E+"px;"),h(p)&&(T+="width:"+p+"px;");var I=e.elementCurrentStyle||"";T.length===I.length&&T===I||(e.style.cssText=T,e.elementCurrentStyle=T)},D={styles:function(e){var t=e.mixinConfig,n=e.viewProps,r=e.viewInternalAPI,o=e.viewExternalAPI,i=e.view,a=Object.assign({},n),u={};m(t,[r,o],n);var s=function(){return i.rect?d(i.rect,i.childViews,[n.translateX||0,n.translateY||0],[n.scaleX||0,n.scaleY||0]):null};return r.rect={get:s},o.rect={get:s},t.forEach(function(e){n[e]=void 0===a[e]?g[e]:a[e]}),{write:function(){if(R(u,n))return O(i.element,n),Object.assign(u,Object.assign({},n)),!0},destroy:function(){}}},listeners:function(e){e.mixinConfig,e.viewProps,e.viewInternalAPI;var t,n=e.viewExternalAPI,r=(e.viewState,e.view),o=[],i=(t=r.element,function(e,n){t.addEventListener(e,n)}),a=function(e){return function(t,n){e.removeEventListener(t,n)}}(r.element);return n.on=function(e,t){o.push({type:e,fn:t}),i(e,t)},n.off=function(e,t){o.splice(o.findIndex(function(n){return n.type===e&&n.fn===t}),1),a(e,t)},{write:function(){return!0},destroy:function(){o.forEach(function(e){a(e.type,e.fn)})}}},animations:function(e){var n=e.mixinConfig,r=e.viewProps,o=e.viewInternalAPI,i=e.viewExternalAPI,a=Object.assign({},r),u=[];return t(n,function(e,t){var n=v(t);n&&(n.onupdate=function(t){r[e]=t},n.target=a[e],m([{key:e,setter:function(e){n.target!==e&&(n.target=e)},getter:function(){return r[e]}}],[o,i],r,!0),u.push(n))}),{write:function(e){var t=document.hidden,n=!0;return u.forEach(function(r){r.resting||(n=!1),r.interpolate(e,t)}),n},destroy:function(){}}},apis:function(e){var t=e.mixinConfig,n=e.viewProps,r=e.viewExternalAPI;m(t,r,n)}},y=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};return t.layoutCalculated||(e.paddingTop=parseInt(n.paddingTop,10)||0,e.marginTop=parseInt(n.marginTop,10)||0,e.marginRight=parseInt(n.marginRight,10)||0,e.marginBottom=parseInt(n.marginBottom,10)||0,e.marginLeft=parseInt(n.marginLeft,10)||0,t.layoutCalculated=!0),e.left=t.offsetLeft||0,e.top=t.offsetTop||0,e.width=t.offsetWidth||0,e.height=t.offsetHeight||0,e.right=e.left+e.width,e.bottom=e.top+e.height,e.scrollTop=t.scrollTop,e.hidden=null===t.offsetParent,e},S=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},t=e.tag,r=void 0===t?"div":t,o=e.name,i=void 0===o?null:o,l=e.attributes,c=void 0===l?{}:l,p=e.read,E=void 0===p?function(){}:p,_=e.write,T=void 0===_?function(){}:_,I=e.create,v=void 0===I?function(){}:I,m=e.destroy,h=void 0===m?function(){}:m,g=e.filterFrameActionsForChild,R=void 0===g?function(e,t){return t}:g,O=e.didCreateView,S=void 0===O?function(){}:O,A=e.didWriteView,L=void 0===A?function(){}:A,P=e.ignoreRect,b=void 0!==P&&P,M=e.ignoreRectUpdate,w=void 0!==M&&M,C=e.mixins,N=void 0===C?[]:C;return function(e){var t,o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},l=a(r,"filepond--"+i,c),p=window.getComputedStyle(l,null),_=y(),I=null,m=!1,g=[],O=[],A={},P={},M=[T],C=[E],G=[h],U=function(){return l},B=function(){return g.concat()},q=function(){return I||(I=d(_,g,[0,0],[1,1]))},F={element:{get:U},style:{get:function(){return p}},childViews:{get:B}},V=Object.assign({},F,{rect:{get:q},ref:{get:function(){return A}},is:function(e){return i===e},appendChild:(t=l,function(e,n){void 0!==n&&t.children[n]?t.insertBefore(e,t.children[n]):t.appendChild(e)}),createChildView:function(e){return function(t,n){return t(e,n)}}(e),linkView:function(e){return g.push(e),e},unlinkView:function(e){g.splice(g.indexOf(e),1)},appendChildView:u(0,g),removeChildView:s(l,g),registerWriter:function(e){return M.push(e)},registerReader:function(e){return C.push(e)},registerDestroyer:function(e){return G.push(e)},invalidateLayout:function(){return l.layoutCalculated=!1},dispatch:e.dispatch,query:e.query}),x={element:{get:U},childViews:{get:B},rect:{get:q},resting:{get:function(){return m}},isRectIgnored:function(){return b},_read:function(){I=null,g.forEach(function(e){return e._read()}),!(w&&_.width&&_.height)&&y(_,l,p);var e={root:j,props:o,rect:_};C.forEach(function(t){return t(e)})},_write:function(e,t,n){var r=0===t.length;return M.forEach(function(i){!1===i({props:o,root:j,actions:t,timestamp:e,shouldOptimize:n})&&(r=!1)}),O.forEach(function(t){!1===t.write(e)&&(r=!1)}),g.filter(function(e){return!!e.element.parentNode}).forEach(function(o){o._write(e,R(o,t),n)||(r=!1)}),g.forEach(function(o,i){o.element.parentNode||(j.appendChild(o.element,i),o._read(),o._write(e,R(o,t),n),r=!1)}),m=r,L({props:o,root:j,actions:t,timestamp:e}),r},_destroy:function(){O.forEach(function(e){return e.destroy()}),G.forEach(function(e){e({root:j,props:o})}),g.forEach(function(e){return e._destroy()})}},Y=Object.assign({},F,{rect:{get:function(){return _}}});Object.keys(N).sort(function(e,t){return"styles"===e?1:"styles"===t?-1:0}).forEach(function(e){var t=D[e]({mixinConfig:N[e],viewProps:o,viewState:P,viewInternalAPI:V,viewExternalAPI:x,view:n(Y)});t&&O.push(t)});var j=n(V);v({root:j,props:o});var k=f(l);return g.forEach(function(e,t){j.appendChild(e.element,k+t)}),S(j),n(x)}},A=function(e,t){return function(n){var r=n.root,o=n.props,i=n.actions,a=void 0===i?[]:i,u=n.timestamp,s=n.shouldOptimize;a.filter(function(t){return e[t.type]}).forEach(function(t){return e[t.type]({root:r,props:o,action:t.data,timestamp:u,shouldOptimize:s})}),t&&t({root:r,props:o,actions:a,timestamp:u,shouldOptimize:s})}},L=function(e,t){return t.parentNode.insertBefore(e,t)},P=function(e,t){return t.parentNode.insertBefore(e,t.nextSibling)},b=function(e){return Array.isArray(e)},M=function(e){return null==e},w=function(e){return e.trim()},C=function(e){return""+e},N=function(e){return"boolean"==typeof e},G=function(e){return N(e)?e:"true"===e},U=function(e){return"string"==typeof e},B=function(e){return _(e)?e:U(e)?C(e).replace(/[a-z]+/gi,""):0},q=function(e){return parseInt(B(e),10)},F=function(e){return parseFloat(B(e))},V=function(e){return _(e)&&isFinite(e)&&Math.floor(e)===e},x=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:1e3;if(V(e))return e;var n=C(e).trim();return/MB$/i.test(n)?(n=n.replace(/MB$i/,"").trim(),q(n)*t*t):/KB/i.test(n)?(n=n.replace(/KB$i/,"").trim(),q(n)*t):q(n)},Y=function(e){return"function"==typeof e},j={process:"POST",patch:"PATCH",revert:"DELETE",fetch:"GET",restore:"GET",load:"GET"},k=function(e,t,n,r,o){if(null===t)return null;if("function"==typeof t)return t;var i={url:"GET"===n||"PATCH"===n?"?"+e+"=":"",method:n,headers:o,withCredentials:!1,timeout:r,onload:null,ondata:null,onerror:null};if(U(t))return i.url=t,i;if(Object.assign(i,t),U(i.headers)){var a=i.headers.split(/:(.+)/);i.headers={header:a[0],value:a[1]}}return i.withCredentials=G(i.withCredentials),i},H=function(e){return"object"==typeof e&&null!==e},X=function(e){return b(e)?"array":function(e){return null===e}(e)?"null":V(e)?"int":/^[0-9]+ ?(?:GB|MB|KB)$/gi.test(e)?"bytes":function(e){return H(e)&&U(e.url)&&H(e.process)&&H(e.revert)&&H(e.restore)&&H(e.fetch)}(e)?"api":typeof e},W={array:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:",";return M(e)?[]:b(e)?e:C(e).split(t).map(w).filter(function(e){return e.length})},boolean:G,int:function(e){return"bytes"===X(e)?x(e):q(e)},number:F,float:F,bytes:x,string:function(e){return Y(e)?e:C(e)},function:function(e){return function(e){for(var t=self,n=e.split("."),r=null;r=n.shift();)if(!(t=t[r]))return null;return t}(e)},serverapi:function(e){return(r={}).url=U(n=e)?n:n.url||"",r.timeout=n.timeout?parseInt(n.timeout,10):0,r.headers=n.headers?n.headers:{},t(j,function(e){r[e]=k(e,n[e],j[e],r.timeout,r.headers)}),r.process=n.process||U(n)||n.url?r.process:null,r.remove=n.remove||null,delete r.headers,r;var n,r},object:function(e){try{return JSON.parse(e.replace(/{\s*'/g,'{"').replace(/'\s*}/g,'"}').replace(/'\s*:/g,'":').replace(/:\s*'/g,':"').replace(/,\s*'/g,',"').replace(/'\s*,/g,'",'))}catch(e){return null}}},z=function(e,t,n){if(e===t)return e;var r,o=X(e);if(o!==n){var i=(r=e,W[n](r));if(o=X(i),null===i)throw'Trying to assign value with incorrect type to "'+option+'", allowed type: "'+n+'"';e=i}return e},Q=function(e){var r={};return t(e,function(t){var n,o,i,a=e[t];r[t]=(n=a[0],o=a[1],i=n,{enumerable:!0,get:function(){return i},set:function(e){i=z(e,n,o)}})}),n(r)},Z=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"-";return e.split(/(?=[A-Z])/).map(function(e){return e.toLowerCase()}).join(t)},$=function(e){return function(n,r,o){var i={};return t(e,function(e){var t=Z(e,"_").toUpperCase();i["SET_"+t]=function(r){try{o.options[e]=r.value}catch(e){}n("DID_SET_"+t,{value:o.options[e]})}}),i}},K=function(e){return function(n){var r={};return t(e,function(e){r["GET_"+Z(e,"_").toUpperCase()]=function(t){return n.options[e]}}),r}},J=1,ee=2,te=3,ne=4,re=5,oe=function(){return Math.random().toString(36).substr(2,9)};function ie(e){this.wrapped=e}function ae(e){var t,n;function r(t,n){try{var i=e[t](n),a=i.value,u=a instanceof ie;Promise.resolve(u?a.wrapped:a).then(function(e){u?r("next",e):o(i.done?"return":"normal",e)},function(e){r("throw",e)})}catch(e){o("throw",e)}}function o(e,o){switch(e){case"return":t.resolve({value:o,done:!0});break;case"throw":t.reject(o);break;default:t.resolve({value:o,done:!1})}(t=t.next)?r(t.key,t.arg):n=null}this._invoke=function(e,o){return new Promise(function(i,a){var u={key:e,arg:o,resolve:i,reject:a,next:null};n?n=n.next=u:(t=n=u,r(e,o))})},"function"!=typeof e.return&&(this.return=void 0)}function ue(e,t){if(null==e)return{};var n,r,o=function(e,t){if(null==e)return{};var n,r,o={},i=Object.keys(e);for(r=0;r<i.length;r++)n=i[r],t.indexOf(n)>=0||(o[n]=e[n]);return o}(e,t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);for(r=0;r<i.length;r++)n=i[r],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(o[n]=e[n])}return o}"function"==typeof Symbol&&Symbol.asyncIterator&&(ae.prototype[Symbol.asyncIterator]=function(){return this}),ae.prototype.next=function(e){return this._invoke("next",e)},ae.prototype.throw=function(e){return this._invoke("throw",e)},ae.prototype.return=function(e){return this._invoke("return",e)};function se(e){return function(e){if(Array.isArray(e)){for(var t=0,n=new Array(e.length);t<e.length;t++)n[t]=e[t];return n}}(e)||le(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance")}()}function le(e){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e))return Array.from(e)}var ce,fe,de=function(e,t){return e.splice(t,1)},pe=function(){var e=[],t=function(t,n){de(e,e.findIndex(function(e){return e.event===t&&(e.cb===n||!n)}))},n=function(t,n,r){e.filter(function(e){return e.event===t}).map(function(e){return e.cb}).forEach(function(e){return function(e,t){t?e():document.hidden?Promise.resolve(1).then(e):setTimeout(e,0)}(function(){return e.apply(void 0,se(n))},r)})};return{fireSync:function(e){for(var t=arguments.length,r=new Array(t>1?t-1:0),o=1;o<t;o++)r[o-1]=arguments[o];n(e,r,!0)},fire:function(e){for(var t=arguments.length,r=new Array(t>1?t-1:0),o=1;o<t;o++)r[o-1]=arguments[o];n(e,r,!1)},on:function(t,n){e.push({event:t,cb:n})},onOnce:function(n,r){e.push({event:n,cb:function(){t(n,r),r.apply(void 0,arguments)}})},off:t}},Ee=function(e,t,n){Object.getOwnPropertyNames(e).filter(function(e){return!n.includes(e)}).forEach(function(n){return Object.defineProperty(t,n,Object.getOwnPropertyDescriptor(e,n))})},_e=["fire","process","revert","load","on","off","onOnce","retryLoad","extend","archive","archived","release","released","requestProcessing","freeze"],Te=function(e){var t={};return Ee(e,t,_e),t},Ie={INIT:1,IDLE:2,PROCESSING_QUEUED:9,PROCESSING:3,PROCESSING_COMPLETE:5,PROCESSING_ERROR:6,PROCESSING_REVERT_ERROR:10,LOADING:7,LOAD_ERROR:8},ve={INPUT:1,LIMBO:2,LOCAL:3},me=function(e){return/[^0-9]+/.exec(e)},he=function(){return me(1.1.toLocaleString())[0]},ge={BOOLEAN:"boolean",INT:"int",NUMBER:"number",STRING:"string",ARRAY:"array",OBJECT:"object",FUNCTION:"function",ACTION:"action",SERVER_API:"serverapi",REGEX:"regex"},Re=[],Oe=function(e,t,n){return new Promise(function(r,o){var i=Re.filter(function(t){return t.key===e}).map(function(e){return e.cb});if(0!==i.length){var a=i.shift();i.reduce(function(e,t){return e.then(function(e){return t(e,n)})},a(t,n)).then(function(e){return r(e)}).catch(function(e){return o(e)})}else r(t)})},De=function(e,t,n){return Re.filter(function(t){return t.key===e}).map(function(e){return e.cb(t,n)})},ye=function(e,t){return Re.push({key:e,cb:t})},Se=function(){return Object.assign({},Ae)},Ae={id:[null,ge.STRING],name:["filepond",ge.STRING],disabled:[!1,ge.BOOLEAN],className:[null,ge.STRING],required:[!1,ge.BOOLEAN],captureMethod:[null,ge.STRING],allowSyncAcceptAttribute:[!0,ge.BOOLEAN],allowDrop:[!0,ge.BOOLEAN],allowBrowse:[!0,ge.BOOLEAN],allowPaste:[!0,ge.BOOLEAN],allowMultiple:[!1,ge.BOOLEAN],allowReplace:[!0,ge.BOOLEAN],allowRevert:[!0,ge.BOOLEAN],allowRemove:[!0,ge.BOOLEAN],allowProcess:[!0,ge.BOOLEAN],allowReorder:[!1,ge.BOOLEAN],allowDirectoriesOnly:[!1,ge.BOOLEAN],storeAsFile:[!1,ge.BOOLEAN],forceRevert:[!1,ge.BOOLEAN],maxFiles:[null,ge.INT],checkValidity:[!1,ge.BOOLEAN],itemInsertLocationFreedom:[!0,ge.BOOLEAN],itemInsertLocation:["before",ge.STRING],itemInsertInterval:[75,ge.INT],dropOnPage:[!1,ge.BOOLEAN],dropOnElement:[!0,ge.BOOLEAN],dropValidation:[!1,ge.BOOLEAN],ignoredFiles:[[".ds_store","thumbs.db","desktop.ini"],ge.ARRAY],instantUpload:[!0,ge.BOOLEAN],maxParallelUploads:[2,ge.INT],allowMinimumUploadDuration:[!0,ge.BOOLEAN],chunkUploads:[!1,ge.BOOLEAN],chunkForce:[!1,ge.BOOLEAN],chunkSize:[5e6,ge.INT],chunkRetryDelays:[[500,1e3,3e3],ge.ARRAY],server:[null,ge.SERVER_API],fileSizeBase:[1e3,ge.INT],labelDecimalSeparator:[he(),ge.STRING],labelThousandsSeparator:[(ce=he(),fe=1e3.toLocaleString(),fe!==1e3.toString()?me(fe)[0]:"."===ce?",":"."),ge.STRING],labelIdle:['Drag & Drop your files or <span class="filepond--label-action">Browse</span>',ge.STRING],labelInvalidField:["Field contains invalid files",ge.STRING],labelFileWaitingForSize:["Waiting for size",ge.STRING],labelFileSizeNotAvailable:["Size not available",ge.STRING],labelFileCountSingular:["file in list",ge.STRING],labelFileCountPlural:["files in list",ge.STRING],labelFileLoading:["Loading",ge.STRING],labelFileAdded:["Added",ge.STRING],labelFileLoadError:["Error during load",ge.STRING],labelFileRemoved:["Removed",ge.STRING],labelFileRemoveError:["Error during remove",ge.STRING],labelFileProcessing:["Uploading",ge.STRING],labelFileProcessingComplete:["Upload complete",ge.STRING],labelFileProcessingAborted:["Upload cancelled",ge.STRING],labelFileProcessingError:["Error during upload",ge.STRING],labelFileProcessingRevertError:["Error during revert",ge.STRING],labelTapToCancel:["tap to cancel",ge.STRING],labelTapToRetry:["tap to retry",ge.STRING],labelTapToUndo:["tap to undo",ge.STRING],labelButtonRemoveItem:["Remove",ge.STRING],labelButtonAbortItemLoad:["Abort",ge.STRING],labelButtonRetryItemLoad:["Retry",ge.STRING],labelButtonAbortItemProcessing:["Cancel",ge.STRING],labelButtonUndoItemProcessing:["Undo",ge.STRING],labelButtonRetryItemProcessing:["Retry",ge.STRING],labelButtonProcessItem:["Upload",ge.STRING],iconRemove:['<svg width="26" height="26" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg"><path d="M11.586 13l-2.293 2.293a1 1 0 0 0 1.414 1.414L13 14.414l2.293 2.293a1 1 0 0 0 1.414-1.414L14.414 13l2.293-2.293a1 1 0 0 0-1.414-1.414L13 11.586l-2.293-2.293a1 1 0 0 0-1.414 1.414L11.586 13z" fill="currentColor" fill-rule="nonzero"/></svg>',ge.STRING],iconProcess:['<svg width="26" height="26" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg"><path d="M14 10.414v3.585a1 1 0 0 1-2 0v-3.585l-1.293 1.293a1 1 0 0 1-1.414-1.415l3-3a1 1 0 0 1 1.414 0l3 3a1 1 0 0 1-1.414 1.415L14 10.414zM9 18a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2H9z" fill="currentColor" fill-rule="evenodd"/></svg>',ge.STRING],iconRetry:['<svg width="26" height="26" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg"><path d="M10.81 9.185l-.038.02A4.997 4.997 0 0 0 8 13.683a5 5 0 0 0 5 5 5 5 0 0 0 5-5 1 1 0 0 1 2 0A7 7 0 1 1 9.722 7.496l-.842-.21a.999.999 0 1 1 .484-1.94l3.23.806c.535.133.86.675.73 1.21l-.804 3.233a.997.997 0 0 1-1.21.73.997.997 0 0 1-.73-1.21l.23-.928v-.002z" fill="currentColor" fill-rule="nonzero"/></svg>',ge.STRING],iconUndo:['<svg width="26" height="26" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg"><path d="M9.185 10.81l.02-.038A4.997 4.997 0 0 1 13.683 8a5 5 0 0 1 5 5 5 5 0 0 1-5 5 1 1 0 0 0 0 2A7 7 0 1 0 7.496 9.722l-.21-.842a.999.999 0 1 0-1.94.484l.806 3.23c.133.535.675.86 1.21.73l3.233-.803a.997.997 0 0 0 .73-1.21.997.997 0 0 0-1.21-.73l-.928.23-.002-.001z" fill="currentColor" fill-rule="nonzero"/></svg>',ge.STRING],iconDone:['<svg width="26" height="26" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg"><path d="M18.293 9.293a1 1 0 0 1 1.414 1.414l-7.002 7a1 1 0 0 1-1.414 0l-3.998-4a1 1 0 1 1 1.414-1.414L12 15.586l6.294-6.293z" fill="currentColor" fill-rule="nonzero"/></svg>',ge.STRING],oninit:[null,ge.FUNCTION],onwarning:[null,ge.FUNCTION],onerror:[null,ge.FUNCTION],onactivatefile:[null,ge.FUNCTION],oninitfile:[null,ge.FUNCTION],onaddfilestart:[null,ge.FUNCTION],onaddfileprogress:[null,ge.FUNCTION],onaddfile:[null,ge.FUNCTION],onprocessfilestart:[null,ge.FUNCTION],onprocessfileprogress:[null,ge.FUNCTION],onprocessfileabort:[null,ge.FUNCTION],onprocessfilerevert:[null,ge.FUNCTION],onprocessfile:[null,ge.FUNCTION],onprocessfiles:[null,ge.FUNCTION],onremovefile:[null,ge.FUNCTION],onpreparefile:[null,ge.FUNCTION],onupdatefiles:[null,ge.FUNCTION],onreorderfiles:[null,ge.FUNCTION],beforeDropFile:[null,ge.FUNCTION],beforeAddFile:[null,ge.FUNCTION],beforeRemoveFile:[null,ge.FUNCTION],beforePrepareFile:[null,ge.FUNCTION],stylePanelLayout:[null,ge.STRING],stylePanelAspectRatio:[null,ge.STRING],styleItemPanelAspectRatio:[null,ge.STRING],styleButtonRemoveItemPosition:["left",ge.STRING],styleButtonProcessItemPosition:["right",ge.STRING],styleLoadIndicatorPosition:["right",ge.STRING],styleProgressIndicatorPosition:["right",ge.STRING],styleButtonRemoveItemAlign:[!1,ge.BOOLEAN],files:[[],ge.ARRAY],credits:[["https://pqina.nl/","Powered by PQINA"],ge.ARRAY]},Le=function(e,t){return M(t)?e[0]||null:V(t)?e[t]||null:("object"==typeof t&&(t=t.id),e.find(function(e){return e.id===t})||null)},Pe=function(e){if(M(e))return e;if(/:/.test(e)){var t=e.split(":");return t[1]/t[0]}return parseFloat(e)},be=function(e){return e.filter(function(e){return!e.archived})},Me={EMPTY:0,IDLE:1,ERROR:2,BUSY:3,READY:4},we=null,Ce=[Ie.LOAD_ERROR,Ie.PROCESSING_ERROR,Ie.PROCESSING_REVERT_ERROR],Ne=[Ie.LOADING,Ie.PROCESSING,Ie.PROCESSING_QUEUED,Ie.INIT],Ge=[Ie.PROCESSING_COMPLETE],Ue=function(e){return Ce.includes(e.status)},Be=function(e){return Ne.includes(e.status)},qe=function(e){return Ge.includes(e.status)},Fe=function(e){return H(e.options.server)&&(H(e.options.server.process)||Y(e.options.server.process))},Ve=function(e){return{GET_STATUS:function(){var t=be(e.items),n=Me.EMPTY,r=Me.ERROR,o=Me.BUSY,i=Me.IDLE,a=Me.READY;return 0===t.length?n:t.some(Ue)?r:t.some(Be)?o:t.some(qe)?a:i},GET_ITEM:function(t){return Le(e.items,t)},GET_ACTIVE_ITEM:function(t){return Le(be(e.items),t)},GET_ACTIVE_ITEMS:function(){return be(e.items)},GET_ITEMS:function(){return e.items},GET_ITEM_NAME:function(t){var n=Le(e.items,t);return n?n.filename:null},GET_ITEM_SIZE:function(t){var n=Le(e.items,t);return n?n.fileSize:null},GET_STYLES:function(){return Object.keys(e.options).filter(function(e){return/^style/.test(e)}).map(function(t){return{name:t,value:e.options[t]}})},GET_PANEL_ASPECT_RATIO:function(){return/circle/.test(e.options.stylePanelLayout)?1:Pe(e.options.stylePanelAspectRatio)},GET_ITEM_PANEL_ASPECT_RATIO:function(){return e.options.styleItemPanelAspectRatio},GET_ITEMS_BY_STATUS:function(t){return be(e.items).filter(function(e){return e.status===t})},GET_TOTAL_ITEMS:function(){return be(e.items).length},SHOULD_UPDATE_FILE_INPUT:function(){return e.options.storeAsFile&&function(){if(null===we)try{var e=new DataTransfer;e.items.add(new File(["hello world"],"This_Works.txt"));var t=document.createElement("input");t.setAttribute("type","file"),t.files=e.files,we=1===t.files.length}catch(e){we=!1}return we}()&&!Fe(e)},IS_ASYNC:function(){return Fe(e)}}},xe=function(e,t,n){return Math.max(Math.min(n,e),t)},Ye=function(e){return/^\s*data:([a-z]+\/[a-z0-9-+.]+(;[a-z-]+=[a-z0-9-]+)?)?(;base64)?,([a-z0-9!$&',()*+;=\-._~:@\/?%\s]*)\s*$/i.test(e)},je=function(e){return e.split("/").pop().split("?").shift()},ke=function(e){return e.split(".").pop()},He=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"";return(t+e).slice(-t.length)},Xe=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:new Date;return e.getFullYear()+"-"+He(e.getMonth()+1,"00")+"-"+He(e.getDate(),"00")+"_"+He(e.getHours(),"00")+"-"+He(e.getMinutes(),"00")+"-"+He(e.getSeconds(),"00")},We=function(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null,r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null,o="string"==typeof n?e.slice(0,e.size,n):e.slice(0,e.size,e.type);return o.lastModifiedDate=new Date,e._relativePath&&(o._relativePath=e._relativePath),U(t)||(t=Xe()),t&&null===r&&ke(t)?o.name=t:(r=r||function(e){if("string"!=typeof e)return"";var t=e.split("/").pop();return/svg/.test(t)?"svg":/zip|compressed/.test(t)?"zip":/plain/.test(t)?"txt":/msword/.test(t)?"doc":/[a-z]+/.test(t)?"jpeg"===t?"jpg":t:""}(o.type),o.name=t+(r?"."+r:"")),o},ze=function(e,t){var n=window.BlobBuilder=window.BlobBuilder||window.WebKitBlobBuilder||window.MozBlobBuilder||window.MSBlobBuilder;if(n){var r=new n;return r.append(e),r.getBlob(t)}return new Blob([e],{type:t})},Qe=function(e){return(/^data:(.+);/.exec(e)||[])[1]||null},Ze=function(e){var t=Qe(e);return function(e,t){for(var n=new ArrayBuffer(e.length),r=new Uint8Array(n),o=0;o<e.length;o++)r[o]=e.charCodeAt(o);return ze(n,t)}(function(e){return atob(function(e){return e.split(",")[1].replace(/\s/g,"")}(e))}(e),t)},$e=function(e){if(!/^content-disposition:/i.test(e))return null;var t=e.split(/filename=|filename\*=.+''/).splice(1).map(function(e){return e.trim().replace(/^["']|[;"']{0,2}$/g,"")}).filter(function(e){return e.length});return t.length?decodeURI(t[t.length-1]):null},Ke=function(e){if(/content-length:/i.test(e)){var t=e.match(/[0-9]+/)[0];return t?parseInt(t,10):null}return null},Je=function(e){return/x-content-transfer-id:/i.test(e)&&(e.split(":")[1]||"").trim()||null},et=function(e){var t={source:null,name:null,size:null},n=e.split("\n"),r=!0,o=!1,i=void 0;try{for(var a,u=n[Symbol.iterator]();!(r=(a=u.next()).done);r=!0){var s=a.value,l=$e(s);if(l)t.name=l;else{var c=Ke(s);if(c)t.size=c;else{var f=Je(s);f&&(t.source=f)}}}}catch(e){o=!0,i=e}finally{try{r||null==u.return||u.return()}finally{if(o)throw i}}return t},tt=function(e){var t={source:null,complete:!1,progress:0,size:null,timestamp:null,duration:0,request:null},n=function(n){e?(t.timestamp=Date.now(),t.request=e(n,function(e){t.duration=Date.now()-t.timestamp,t.complete=!0,e instanceof Blob&&(e=We(e,e.name||je(n))),r.fire("load",e instanceof Blob?e:e?e.body:null)},function(e){r.fire("error","string"==typeof e?{type:"error",code:0,body:e}:e)},function(e,n,o){o&&(t.size=o),t.duration=Date.now()-t.timestamp,e?(t.progress=n/o,r.fire("progress",t.progress)):t.progress=null},function(){r.fire("abort")},function(e){var n=et("string"==typeof e?e:e.headers);r.fire("meta",{size:t.size||n.size,filename:n.name,source:n.source})})):r.fire("error",{type:"error",body:"Can't load URL",code:400})},r=Object.assign({},pe(),{setSource:function(e){return t.source=e},getProgress:function(){return t.progress},abort:function(){t.request&&t.request.abort&&t.request.abort()},load:function(){var e,o,i=t.source;r.fire("init",i),i instanceof File?r.fire("load",i):i instanceof Blob?r.fire("load",We(i,i.name)):Ye(i)?r.fire("load",We(Ze(i),e,null,o)):n(i)}});return r},nt=function(e){return/GET|HEAD/.test(e)},rt=function(e,t,n){var r={onheaders:function(){},onprogress:function(){},onload:function(){},ontimeout:function(){},onerror:function(){},onabort:function(){},abort:function(){o=!0,a.abort()}},o=!1,i=!1;n=Object.assign({method:"POST",headers:{},withCredentials:!1},n),t=encodeURI(t),nt(n.method)&&e&&(t=""+t+encodeURIComponent("string"==typeof e?e:JSON.stringify(e)));var a=new XMLHttpRequest;return(nt(n.method)?a:a.upload).onprogress=function(e){o||r.onprogress(e.lengthComputable,e.loaded,e.total)},a.onreadystatechange=function(){a.readyState<2||4===a.readyState&&0===a.status||i||(i=!0,r.onheaders(a))},a.onload=function(){a.status>=200&&a.status<300?r.onload(a):r.onerror(a)},a.onerror=function(){return r.onerror(a)},a.onabort=function(){o=!0,r.onabort()},a.ontimeout=function(){return r.ontimeout(a)},a.open(n.method,t,!0),V(n.timeout)&&(a.timeout=n.timeout),Object.keys(n.headers).forEach(function(e){var t=unescape(encodeURIComponent(n.headers[e]));a.setRequestHeader(e,t)}),n.responseType&&(a.responseType=n.responseType),n.withCredentials&&(a.withCredentials=!0),a.send(e),r},ot=function(e,t,n,r){return{type:e,code:t,body:n,headers:r}},it=function(e){return function(t){e(ot("error",0,"Timeout",t.getAllResponseHeaders()))}},at=function(e){return/\?/.test(e)},ut=function(){for(var e="",t=arguments.length,n=new Array(t),r=0;r<t;r++)n[r]=arguments[r];return n.forEach(function(t){e+=at(e)&&at(t)?t.replace(/\?/,"&"):t}),e},st=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",t=arguments.length>1?arguments[1]:void 0;if("function"==typeof t)return t;if(!t||!U(t.url))return null;var n=t.onload||function(e){return e},r=t.onerror||function(e){return null};return function(o,i,a,u,s,l){var c=rt(o,ut(e,t.url),Object.assign({},t,{responseType:"blob"}));return c.onload=function(e){var r=e.getAllResponseHeaders(),a=et(r).name||je(o);i(ot("load",e.status,"HEAD"===t.method?null:We(n(e.response),a),r))},c.onerror=function(e){a(ot("error",e.status,r(e.response)||e.statusText,e.getAllResponseHeaders()))},c.onheaders=function(e){l(ot("headers",e.status,null,e.getAllResponseHeaders()))},c.ontimeout=it(a),c.onprogress=u,c.onabort=s,c}},lt=0,ct=1,ft=2,dt=3,pt=4,Et=function(e,t,n,r,o,i,a,u,s,l,c){for(var f=[],d=c.chunkTransferId,p=c.chunkServer,E=c.chunkSize,_=c.chunkRetryDelays,T={serverId:d,aborted:!1},I=t.ondata||function(e){return e},v=t.onload||function(e,t){return"HEAD"===t?e.getResponseHeader("Upload-Offset"):e.response},m=t.onerror||function(e){return null},h=Math.floor(r.size/E),g=0;g<=h;g++){var R=g*E,O=r.slice(R,R+E,"application/offset+octet-stream");f[g]={index:g,size:O.size,offset:R,data:O,file:r,progress:0,retries:se(_),status:lt,error:null,request:null,timeout:null}}var D,y,S,A,L=function(e){return e.status===lt||e.status===dt},P=function(t){if(!T.aborted)if(t=t||f.find(L)){t.status=ft,t.progress=null;var n=p.ondata||function(e){return e},o=p.onerror||function(e){return null},u=ut(e,p.url,T.serverId),l="function"==typeof p.headers?p.headers(t):Object.assign({},p.headers,{"Content-Type":"application/offset+octet-stream","Upload-Offset":t.offset,"Upload-Length":r.size,"Upload-Name":r.name}),c=t.request=rt(n(t.data),u,Object.assign({},p,{headers:l}));c.onload=function(){t.status=ct,t.request=null,w()},c.onprogress=function(e,n,r){t.progress=e?n:null,M()},c.onerror=function(e){t.status=dt,t.request=null,t.error=o(e.response)||e.statusText,b(t)||a(ot("error",e.status,o(e.response)||e.statusText,e.getAllResponseHeaders()))},c.ontimeout=function(e){t.status=dt,t.request=null,b(t)||it(a)(e)},c.onabort=function(){t.status=lt,t.request=null,s()}}else f.every(function(e){return e.status===ct})&&i(T.serverId)},b=function(e){return 0!==e.retries.length&&(e.status=pt,clearTimeout(e.timeout),e.timeout=setTimeout(function(){P(e)},e.retries.shift()),!0)},M=function(){var e=f.reduce(function(e,t){return null===e||null===t.progress?null:e+t.progress},0);if(null===e)return u(!1,0,0);var t=f.reduce(function(e,t){return e+t.size},0);u(!0,e,t)},w=function(){f.filter(function(e){return e.status===ft}).length>=1||P()};return T.serverId?(D=function(e){T.aborted||(f.filter(function(t){return t.offset<e}).forEach(function(e){e.status=ct,e.progress=e.size}),w())},y=ut(e,p.url,T.serverId),S={headers:"function"==typeof t.headers?t.headers(T.serverId):Object.assign({},t.headers),method:"HEAD"},(A=rt(null,y,S)).onload=function(e){return D(v(e,S.method))},A.onerror=function(e){return a(ot("error",e.status,m(e.response)||e.statusText,e.getAllResponseHeaders()))},A.ontimeout=it(a)):function(i){var u=new FormData;H(o)&&u.append(n,JSON.stringify(o));var s="function"==typeof t.headers?t.headers(r,o):Object.assign({},t.headers,{"Upload-Length":r.size}),l=Object.assign({},t,{headers:s}),c=rt(I(u),ut(e,t.url),l);c.onload=function(e){return i(v(e,l.method))},c.onerror=function(e){return a(ot("error",e.status,m(e.response)||e.statusText,e.getAllResponseHeaders()))},c.ontimeout=it(a)}(function(e){T.aborted||(l(e),T.serverId=e,w())}),{abort:function(){T.aborted=!0,f.forEach(function(e){clearTimeout(e.timeout),e.request&&e.request.abort()})}}},_t=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",t=arguments.length>1?arguments[1]:void 0,n=arguments.length>2?arguments[2]:void 0,r=arguments.length>3?arguments[3]:void 0;return"function"==typeof t?function(){for(var e=arguments.length,o=new Array(e),i=0;i<e;i++)o[i]=arguments[i];return t.apply(void 0,[n].concat(o,[r]))}:t&&U(t.url)?function(e,t,n,r){return function(o,i,a,u,s,l,c){if(o){var f=r.chunkUploads,d=f&&o.size>r.chunkSize,p=f&&(d||r.chunkForce);if(o instanceof Blob&&p)return Et(e,t,n,o,i,a,u,s,l,c,r);var E=t.ondata||function(e){return e},_=t.onload||function(e){return e},T=t.onerror||function(e){return null},I="function"==typeof t.headers?t.headers(o,i)||{}:Object.assign({},t.headers),v=Object.assign({},t,{headers:I}),m=new FormData;H(i)&&m.append(n,JSON.stringify(i)),(o instanceof Blob?[{name:null,file:o}]:o).forEach(function(e){m.append(n,e.file,null===e.name?e.file.name:""+e.name+e.file.name)});var h=rt(E(m),ut(e,t.url),v);return h.onload=function(e){a(ot("load",e.status,_(e.response),e.getAllResponseHeaders()))},h.onerror=function(e){u(ot("error",e.status,T(e.response)||e.statusText,e.getAllResponseHeaders()))},h.ontimeout=it(u),h.onprogress=s,h.onabort=l,h}}}(e,t,n,r):null},Tt=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",t=arguments.length>1?arguments[1]:void 0;if("function"==typeof t)return t;if(!t||!U(t.url))return function(e,t){return t()};var n=t.onload||function(e){return e},r=t.onerror||function(e){return null};return function(o,i,a){var u=rt(o,e+t.url,t);return u.onload=function(e){i(ot("load",e.status,n(e.response),e.getAllResponseHeaders()))},u.onerror=function(e){a(ot("error",e.status,r(e.response)||e.statusText,e.getAllResponseHeaders()))},u.ontimeout=it(a),u}},It=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0,t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:1;return e+Math.random()*(t-e)},vt=function(e,t){var n={complete:!1,perceivedProgress:0,perceivedPerformanceUpdater:null,progress:null,timestamp:null,perceivedDuration:0,duration:0,request:null,response:null},r=t.allowMinimumUploadDuration,o=function(){n.request&&(n.perceivedPerformanceUpdater.clear(),n.request.abort&&n.request.abort(),n.complete=!0)},i=r?function(){return n.progress?Math.min(n.progress,n.perceivedProgress):null}:function(){return n.progress||null},a=r?function(){return Math.min(n.duration,n.perceivedDuration)}:function(){return n.duration},u=Object.assign({},pe(),{process:function(t,o){var i=function(){0!==n.duration&&null!==n.progress&&u.fire("progress",u.getProgress())},a=function(){n.complete=!0,u.fire("load-perceived",n.response.body)};u.fire("start"),n.timestamp=Date.now(),n.perceivedPerformanceUpdater=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:1e3,n=(arguments.length>2&&void 0!==arguments[2]&&arguments[2],arguments.length>3&&void 0!==arguments[3]?arguments[3]:25),r=arguments.length>4&&void 0!==arguments[4]?arguments[4]:250,o=null,i=Date.now();return t>0&&function a(){var u=Date.now()-i,s=It(n,r);u+s>t&&(s=u+s-t);var l=u/t;l>=1||document.hidden?e(1):(e(l),o=setTimeout(a,s))}(),{clear:function(){clearTimeout(o)}}}(function(e){n.perceivedProgress=e,n.perceivedDuration=Date.now()-n.timestamp,i(),n.response&&1===n.perceivedProgress&&!n.complete&&a()},r?It(750,1500):0),n.request=e(t,o,function(e){n.response=H(e)?e:{type:"load",code:200,body:""+e,headers:{}},n.duration=Date.now()-n.timestamp,n.progress=1,u.fire("load",n.response.body),(!r||r&&1===n.perceivedProgress)&&a()},function(e){n.perceivedPerformanceUpdater.clear(),u.fire("error",H(e)?e:{type:"error",code:0,body:""+e})},function(e,t,r){n.duration=Date.now()-n.timestamp,n.progress=e?t/r:null,i()},function(){n.perceivedPerformanceUpdater.clear(),u.fire("abort",n.response?n.response.body:null)},function(e){u.fire("transfer",e)})},abort:o,getProgress:i,getDuration:a,reset:function(){o(),n.complete=!1,n.perceivedProgress=0,n.progress=0,n.timestamp=null,n.perceivedDuration=0,n.duration=0,n.request=null,n.response=null}});return u},mt=function(e){return e.substr(0,e.lastIndexOf("."))||e},ht=function(e){return!!(e instanceof File||e instanceof Blob&&e.name)},gt=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null,t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null,o=oe(),i={archived:!1,frozen:!1,released:!1,source:null,file:r,serverFileReference:t,transferId:null,processingAborted:!1,status:t?Ie.PROCESSING_COMPLETE:Ie.INIT,activeLoader:null,activeProcessor:null},a=null,u={},s=function(e){return i.status=e},l=function(e){if(!i.released&&!i.frozen){for(var t=arguments.length,n=new Array(t>1?t-1:0),r=1;r<t;r++)n[r-1]=arguments[r];f.fire.apply(f,[e].concat(n))}},c=function(e,t,n){var r=e.split("."),o=r[0],i=r.pop(),a=u;r.forEach(function(e){return a=a[e]}),JSON.stringify(a[i])!==JSON.stringify(t)&&(a[i]=t,l("metadata-update",{key:o,value:u[o],silent:n}))},f=Object.assign({id:{get:function(){return o}},origin:{get:function(){return e},set:function(t){return e=t}},serverId:{get:function(){return i.serverFileReference}},transferId:{get:function(){return i.transferId}},status:{get:function(){return i.status}},filename:{get:function(){return i.file.name}},filenameWithoutExtension:{get:function(){return mt(i.file.name)}},fileExtension:{get:function(){return ke(i.file.name)}},fileType:{get:function(){return i.file.type}},fileSize:{get:function(){return i.file.size}},file:{get:function(){return i.file}},relativePath:{get:function(){return i.file._relativePath}},source:{get:function(){return i.source}},getMetadata:function(e){return function e(t){if(!H(t))return t;var n=b(t)?[]:{};for(var r in t)if(t.hasOwnProperty(r)){var o=t[r];n[r]=o&&H(o)?e(o):o}return n}(e?u[e]:u)},setMetadata:function(e,t,n){if(H(e)){var r=e;return Object.keys(r).forEach(function(e){c(e,r[e],t)}),e}return c(e,t,n),t},extend:function(e,t){return d[e]=t},abortLoad:function(){i.activeLoader?i.activeLoader.abort():(s(Ie.INIT),l("load-abort"))},retryLoad:function(){i.activeLoader&&i.activeLoader.load()},requestProcessing:function(){i.processingAborted=!1,s(Ie.PROCESSING_QUEUED)},abortProcessing:function(){return new Promise(function(e){if(!i.activeProcessor)return i.processingAborted=!0,s(Ie.IDLE),l("process-abort"),void e();a=function(){e()},i.activeProcessor.abort()})},load:function(t,n,r){i.source=t,f.fireSync("init"),i.file?f.fireSync("load-skip"):(i.file=function(e){var t=[e.name,e.size,e.type];return e instanceof Blob||Ye(e)?t[0]=e.name||Xe():Ye(e)?(t[1]=e.length,t[2]=Qe(e)):U(e)&&(t[0]=je(e),t[1]=0,t[2]="application/octet-stream"),{name:t[0],size:t[1],type:t[2]}}(t),n.on("init",function(){l("load-init")}),n.on("meta",function(t){i.file.size=t.size,i.file.filename=t.filename,t.source&&(e=ve.LIMBO,i.serverFileReference=t.source,i.status=Ie.PROCESSING_COMPLETE),l("load-meta")}),n.on("progress",function(e){s(Ie.LOADING),l("load-progress",e)}),n.on("error",function(e){s(Ie.LOAD_ERROR),l("load-request-error",e)}),n.on("abort",function(){s(Ie.INIT),l("load-abort")}),n.on("load",function(t){i.activeLoader=null;var n=function(t){i.file=ht(t)?t:i.file,e===ve.LIMBO&&i.serverFileReference?s(Ie.PROCESSING_COMPLETE):s(Ie.IDLE),l("load")};i.serverFileReference?n(t):r(t,n,function(e){i.file=t,l("load-meta"),s(Ie.LOAD_ERROR),l("load-file-error",e)})}),n.setSource(t),i.activeLoader=n,n.load())},process:function e(t,n){if(i.processingAborted)i.processingAborted=!1;else if(s(Ie.PROCESSING),a=null,i.file instanceof Blob){t.on("load",function(e){i.transferId=null,i.serverFileReference=e}),t.on("transfer",function(e){i.transferId=e}),t.on("load-perceived",function(e){i.activeProcessor=null,i.transferId=null,i.serverFileReference=e,s(Ie.PROCESSING_COMPLETE),l("process-complete",e)}),t.on("start",function(){l("process-start")}),t.on("error",function(e){i.activeProcessor=null,s(Ie.PROCESSING_ERROR),l("process-error",e)}),t.on("abort",function(e){i.activeProcessor=null,i.transferId=null,i.serverFileReference=e,s(Ie.IDLE),l("process-abort"),a&&a()}),t.on("progress",function(e){l("process-progress",e)});var r=console.error;n(i.file,function(e){i.archived||t.process(e,Object.assign({},u))},r),i.activeProcessor=t}else f.on("load",function(){e(t,n)})},revert:function(e,t){return new Promise(function(n,r){null!==i.serverFileReference?(e(i.serverFileReference,function(){i.serverFileReference=null,n()},function(e){t?(s(Ie.PROCESSING_REVERT_ERROR),l("process-revert-error"),r(e)):n()}),s(Ie.IDLE),l("process-revert")):n()})}},pe(),{freeze:function(){return i.frozen=!0},release:function(){return i.released=!0},released:{get:function(){return i.released}},archive:function(){return i.archived=!0},archived:{get:function(){return i.archived}}}),d=n(f);return d},Rt=function(e,t){var n=function(e,t){return M(t)?0:U(t)?e.findIndex(function(e){return e.id===t}):-1}(e,t);if(!(n<0))return e[n]||null},Ot=function(e,t,n,r,o,i){var a=rt(null,e,{method:"GET",responseType:"blob"});return a.onload=function(n){var r=n.getAllResponseHeaders(),o=et(r).name||je(e);t(ot("load",n.status,We(n.response,o),r))},a.onerror=function(e){n(ot("error",e.status,e.statusText,e.getAllResponseHeaders()))},a.onheaders=function(e){i(ot("headers",e.status,null,e.getAllResponseHeaders()))},a.ontimeout=it(n),a.onprogress=r,a.onabort=o,a},Dt=function(e){return 0===e.indexOf("//")&&(e=location.protocol+e),e.toLowerCase().replace("blob:","").replace(/([a-z])?:\/\//,"$1").split("/")[0]},yt=function(e){return function(){return Y(e)?e.apply(void 0,arguments):e}},St=function(e,t){clearTimeout(t.listUpdateTimeout),t.listUpdateTimeout=setTimeout(function(){e("DID_UPDATE_ITEMS",{items:be(t.items)})},0)},At=function(e){for(var t=arguments.length,n=new Array(t>1?t-1:0),r=1;r<t;r++)n[r-1]=arguments[r];return new Promise(function(t){if(!e)return t(!0);var r=e.apply(void 0,n);return null==r?t(!0):"boolean"==typeof r?t(r):void("function"==typeof r.then&&r.then(t))})},Lt=function(e,t){e.items.sort(function(e,n){return t(Te(e),Te(n))})},Pt=function(e,t){return function(){var n=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},r=n.query,o=n.success,i=void 0===o?function(){}:o,a=n.failure,u=void 0===a?function(){}:a,s=ue(n,["query","success","failure"]),l=Le(e.items,r);l?t(l,i,u,s||{}):u({error:ot("error",0,"Item not found"),file:null})}},bt=function(e,n,r){return{ABORT_ALL:function(){be(r.items).forEach(function(e){e.freeze(),e.abortLoad(),e.abortProcessing()})},DID_SET_FILES:function(t){var n=t.value,o=(void 0===n?[]:n).map(function(e){return{source:e.source?e.source:e,options:e.options}}),i=be(r.items);i.forEach(function(t){o.find(function(e){return e.source===t.source||e.source===t.file})||e("REMOVE_ITEM",{query:t,remove:!1})}),i=be(r.items),o.forEach(function(t,n){i.find(function(e){return e.source===t.source||e.file===t.source})||e("ADD_ITEM",Object.assign({},t,{interactionMethod:re,index:n}))})},DID_UPDATE_ITEM_METADATA:function(t){var o=t.id,i=t.action,a=t.change;a.silent||(clearTimeout(r.itemUpdateTimeout),r.itemUpdateTimeout=setTimeout(function(){var t=Rt(r.items,o);if(n("IS_ASYNC")){t.origin===ve.LOCAL&&e("DID_LOAD_ITEM",{id:t.id,error:null,serverFileReference:t.source});var u,s=function(){setTimeout(function(){e("REQUEST_ITEM_PROCESSING",{query:o})},32)};return t.status===Ie.PROCESSING_COMPLETE?(u=r.options.instantUpload,void t.revert(Tt(r.options.server.url,r.options.server.revert),n("GET_FORCE_REVERT")).then(u?s:function(){}).catch(function(){})):t.status===Ie.PROCESSING?function(e){t.abortProcessing().then(e?s:function(){})}(r.options.instantUpload):void(r.options.instantUpload&&s())}Oe("SHOULD_PREPARE_OUTPUT",!1,{item:t,query:n,action:i,change:a}).then(function(r){var i=n("GET_BEFORE_PREPARE_FILE");i&&(r=i(t,r)),r&&e("REQUEST_PREPARE_OUTPUT",{query:o,item:t,success:function(t){e("DID_PREPARE_OUTPUT",{id:o,file:t})}},!0)})},0))},MOVE_ITEM:function(e){var t=e.query,n=e.index,o=Le(r.items,t);if(o){var i=r.items.indexOf(o);i!==(n=xe(n,0,r.items.length-1))&&r.items.splice(n,0,r.items.splice(i,1)[0])}},SORT:function(t){var o=t.compare;Lt(r,o),e("DID_SORT_ITEMS",{items:n("GET_ACTIVE_ITEMS")})},ADD_ITEMS:function(t){var r=t.items,o=t.index,i=t.interactionMethod,a=t.success,u=void 0===a?function(){}:a,s=t.failure,l=void 0===s?function(){}:s,c=o;if(-1===o||void 0===o){var f=n("GET_ITEM_INSERT_LOCATION"),d=n("GET_TOTAL_ITEMS");c="before"===f?0:d}var p=n("GET_IGNORED_FILES"),E=r.filter(function(e){return ht(e)?!p.includes(e.name.toLowerCase()):!M(e)}).map(function(t){return new Promise(function(n,r){e("ADD_ITEM",{interactionMethod:i,source:t.source||t,success:n,failure:r,index:c++,options:t.options||{}})})});Promise.all(E).then(u).catch(l)},ADD_ITEM:function(t){var o=t.source,i=t.index,a=void 0===i?-1:i,u=t.interactionMethod,s=t.success,l=void 0===s?function(){}:s,c=t.failure,f=void 0===c?function(){}:c,d=t.options,p=void 0===d?{}:d;if(M(o))f({error:ot("error",0,"No source"),file:null});else if(!ht(o)||!r.options.ignoredFiles.includes(o.name.toLowerCase())){if(!function(e){var t=be(e.items).length;if(!e.options.allowMultiple)return 0===t;var n=e.options.maxFiles;return null===n||t<n}(r)){if(r.options.allowMultiple||!r.options.allowMultiple&&!r.options.allowReplace){var E=ot("warning",0,"Max files");return e("DID_THROW_MAX_FILES",{source:o,error:E}),void f({error:E,file:null})}var _=be(r.items)[0];if(_.status===Ie.PROCESSING_COMPLETE||_.status===Ie.PROCESSING_REVERT_ERROR){var T=n("GET_FORCE_REVERT");if(_.revert(Tt(r.options.server.url,r.options.server.revert),T).then(function(){T&&e("ADD_ITEM",{source:o,index:a,interactionMethod:u,success:l,failure:f,options:p})}).catch(function(){}),T)return}e("REMOVE_ITEM",{query:_.id})}var I="local"===p.type?ve.LOCAL:"limbo"===p.type?ve.LIMBO:ve.INPUT,v=gt(I,I===ve.INPUT?null:o,p.file);Object.keys(p.metadata||{}).forEach(function(e){v.setMetadata(e,p.metadata[e])}),De("DID_CREATE_ITEM",v,{query:n,dispatch:e});var m=n("GET_ITEM_INSERT_LOCATION");r.options.itemInsertLocationFreedom||(a="before"===m?-1:r.items.length),function(e,t,n){M(t)||(void 0===n?e.push(t):function(e,t,n){e.splice(t,0,n)}(e,n=xe(n,0,e.length),t))}(r.items,v,a),Y(m)&&o&&Lt(r,m);var h=v.id;v.on("init",function(){e("DID_INIT_ITEM",{id:h})}),v.on("load-init",function(){e("DID_START_ITEM_LOAD",{id:h})}),v.on("load-meta",function(){e("DID_UPDATE_ITEM_META",{id:h})}),v.on("load-progress",function(t){e("DID_UPDATE_ITEM_LOAD_PROGRESS",{id:h,progress:t})}),v.on("load-request-error",function(t){var n=yt(r.options.labelFileLoadError)(t);if(t.code>=400&&t.code<500)return e("DID_THROW_ITEM_INVALID",{id:h,error:t,status:{main:n,sub:t.code+" ("+t.body+")"}}),void f({error:t,file:Te(v)});e("DID_THROW_ITEM_LOAD_ERROR",{id:h,error:t,status:{main:n,sub:r.options.labelTapToRetry}})}),v.on("load-file-error",function(t){e("DID_THROW_ITEM_INVALID",{id:h,error:t.status,status:t.status}),f({error:t.status,file:Te(v)})}),v.on("load-abort",function(){e("REMOVE_ITEM",{query:h})}),v.on("load-skip",function(){e("COMPLETE_LOAD_ITEM",{query:h,item:v,data:{source:o,success:l}})}),v.on("load",function(){var t=function(t){t?(v.on("metadata-update",function(t){e("DID_UPDATE_ITEM_METADATA",{id:h,change:t})}),Oe("SHOULD_PREPARE_OUTPUT",!1,{item:v,query:n}).then(function(t){var i=n("GET_BEFORE_PREPARE_FILE");i&&(t=i(v,t));var a=function(){e("COMPLETE_LOAD_ITEM",{query:h,item:v,data:{source:o,success:l}}),St(e,r)};t?e("REQUEST_PREPARE_OUTPUT",{query:h,item:v,success:function(t){e("DID_PREPARE_OUTPUT",{id:h,file:t}),a()}},!0):a()})):e("REMOVE_ITEM",{query:h})};Oe("DID_LOAD_ITEM",v,{query:n,dispatch:e}).then(function(){At(n("GET_BEFORE_ADD_FILE"),Te(v)).then(t)}).catch(function(){t(!1)})}),v.on("process-start",function(){e("DID_START_ITEM_PROCESSING",{id:h})}),v.on("process-progress",function(t){e("DID_UPDATE_ITEM_PROCESS_PROGRESS",{id:h,progress:t})}),v.on("process-error",function(t){e("DID_THROW_ITEM_PROCESSING_ERROR",{id:h,error:t,status:{main:yt(r.options.labelFileProcessingError)(t),sub:r.options.labelTapToRetry}})}),v.on("process-revert-error",function(t){e("DID_THROW_ITEM_PROCESSING_REVERT_ERROR",{id:h,error:t,status:{main:yt(r.options.labelFileProcessingRevertError)(t),sub:r.options.labelTapToRetry}})}),v.on("process-complete",function(t){e("DID_COMPLETE_ITEM_PROCESSING",{id:h,error:null,serverFileReference:t}),e("DID_DEFINE_VALUE",{id:h,value:t})}),v.on("process-abort",function(){e("DID_ABORT_ITEM_PROCESSING",{id:h})}),v.on("process-revert",function(){e("DID_REVERT_ITEM_PROCESSING",{id:h}),e("DID_DEFINE_VALUE",{id:h,value:null})}),e("DID_ADD_ITEM",{id:h,index:a,interactionMethod:u}),St(e,r);var g=r.options.server||{},R=g.url,O=g.load,D=g.restore,y=g.fetch;v.load(o,tt(I===ve.INPUT?U(o)&&function(e){return(e.indexOf(":")>-1||e.indexOf("//")>-1)&&Dt(location.href)!==Dt(e)}(o)&&y?st(R,y):Ot:st(R,I===ve.LIMBO?D:O)),function(e,t,r){Oe("LOAD_FILE",e,{query:n}).then(t).catch(r)})}},REQUEST_PREPARE_OUTPUT:function(e){var t=e.item,r=e.success,o=e.failure,i=void 0===o?function(){}:o,a={error:ot("error",0,"Item not found"),file:null};if(t.archived)return i(a);Oe("PREPARE_OUTPUT",t.file,{query:n,item:t}).then(function(e){Oe("COMPLETE_PREPARE_OUTPUT",e,{query:n,item:t}).then(function(e){if(t.archived)return i(a);r(e)})})},COMPLETE_LOAD_ITEM:function(t){var o=t.item,i=t.data,a=i.success,u=i.source,s=n("GET_ITEM_INSERT_LOCATION");if(Y(s)&&u&&Lt(r,s),e("DID_LOAD_ITEM",{id:o.id,error:null,serverFileReference:o.origin===ve.INPUT?null:u}),a(Te(o)),o.origin!==ve.LOCAL)return o.origin===ve.LIMBO?(e("DID_COMPLETE_ITEM_PROCESSING",{id:o.id,error:null,serverFileReference:u}),void e("DID_DEFINE_VALUE",{id:o.id,value:o.serverId||u})):void(n("IS_ASYNC")&&r.options.instantUpload&&e("REQUEST_ITEM_PROCESSING",{query:o.id}));e("DID_LOAD_LOCAL_ITEM",{id:o.id})},RETRY_ITEM_LOAD:Pt(r,function(e){e.retryLoad()}),REQUEST_ITEM_PREPARE:Pt(r,function(t,n,r){e("REQUEST_PREPARE_OUTPUT",{query:t.id,item:t,success:function(r){e("DID_PREPARE_OUTPUT",{id:t.id,file:r}),n({file:t,output:r})},failure:r},!0)}),REQUEST_ITEM_PROCESSING:Pt(r,function(t,o,i){if(t.status===Ie.IDLE||t.status===Ie.PROCESSING_ERROR)t.status!==Ie.PROCESSING_QUEUED&&(t.requestProcessing(),e("DID_REQUEST_ITEM_PROCESSING",{id:t.id}),e("PROCESS_ITEM",{query:t,success:o,failure:i},!0));else{var a=function(){return e("REQUEST_ITEM_PROCESSING",{query:t,success:o,failure:i})},u=function(){return document.hidden?a():setTimeout(a,32)};t.status===Ie.PROCESSING_COMPLETE||t.status===Ie.PROCESSING_REVERT_ERROR?t.revert(Tt(r.options.server.url,r.options.server.revert),n("GET_FORCE_REVERT")).then(u).catch(function(){}):t.status===Ie.PROCESSING&&t.abortProcessing().then(u)}}),PROCESS_ITEM:Pt(r,function(t,o,i){var a=n("GET_MAX_PARALLEL_UPLOADS");if(n("GET_ITEMS_BY_STATUS",Ie.PROCESSING).length!==a){if(t.status!==Ie.PROCESSING){var u=function t(){var n=r.processingQueue.shift();if(n){var o=n.id,i=n.success,a=n.failure,u=Le(r.items,o);u&&!u.archived?e("PROCESS_ITEM",{query:o,success:i,failure:a},!0):t()}};t.onOnce("process-complete",function(){o(Te(t)),u();var i=r.options.server;if(r.options.instantUpload&&t.origin===ve.LOCAL&&Y(i.remove)){var a=function(){};t.origin=ve.LIMBO,r.options.server.remove(t.source,a,a)}n("GET_ITEMS_BY_STATUS",Ie.PROCESSING_COMPLETE).length===r.items.length&&e("DID_COMPLETE_ITEM_PROCESSING_ALL")}),t.onOnce("process-error",function(e){i({error:e,file:Te(t)}),u()});var s=r.options;t.process(vt(_t(s.server.url,s.server.process,s.name,{chunkTransferId:t.transferId,chunkServer:s.server.patch,chunkUploads:s.chunkUploads,chunkForce:s.chunkForce,chunkSize:s.chunkSize,chunkRetryDelays:s.chunkRetryDelays}),{allowMinimumUploadDuration:n("GET_ALLOW_MINIMUM_UPLOAD_DURATION")}),function(r,o,i){Oe("PREPARE_OUTPUT",r,{query:n,item:t}).then(function(n){e("DID_PREPARE_OUTPUT",{id:t.id,file:n}),o(n)}).catch(i)})}}else r.processingQueue.push({id:t.id,success:o,failure:i})}),RETRY_ITEM_PROCESSING:Pt(r,function(t){e("REQUEST_ITEM_PROCESSING",{query:t})}),REQUEST_REMOVE_ITEM:Pt(r,function(t){At(n("GET_BEFORE_REMOVE_FILE"),Te(t)).then(function(n){n&&e("REMOVE_ITEM",{query:t})})}),RELEASE_ITEM:Pt(r,function(e){e.release()}),REMOVE_ITEM:Pt(r,function(t,o,i,a){var u=function(){var n=t.id;Rt(r.items,n).archive(),e("DID_REMOVE_ITEM",{error:null,id:n,item:t}),St(e,r),o(Te(t))},s=r.options.server;t.origin===ve.LOCAL&&s&&Y(s.remove)&&!1!==a.remove?(e("DID_START_ITEM_REMOVE",{id:t.id}),s.remove(t.source,function(){return u()},function(n){e("DID_THROW_ITEM_REMOVE_ERROR",{id:t.id,error:ot("error",0,n,null),status:{main:yt(r.options.labelFileRemoveError)(n),sub:r.options.labelTapToRetry}})})):(a.revert&&t.origin!==ve.LOCAL&&null!==t.serverId&&t.revert(Tt(r.options.server.url,r.options.server.revert),n("GET_FORCE_REVERT")),u())}),ABORT_ITEM_LOAD:Pt(r,function(e){e.abortLoad()}),ABORT_ITEM_PROCESSING:Pt(r,function(t){t.serverId?e("REVERT_ITEM_PROCESSING",{id:t.id}):t.abortProcessing().then(function(){r.options.instantUpload&&e("REMOVE_ITEM",{query:t.id})})}),REQUEST_REVERT_ITEM_PROCESSING:Pt(r,function(t){if(r.options.instantUpload){var o=function(n){n&&e("REVERT_ITEM_PROCESSING",{query:t})},i=n("GET_BEFORE_REMOVE_FILE");if(!i)return o(!0);var a=i(Te(t));return null==a?o(!0):"boolean"==typeof a?o(a):void("function"==typeof a.then&&a.then(o))}e("REVERT_ITEM_PROCESSING",{query:t})}),REVERT_ITEM_PROCESSING:Pt(r,function(t){t.revert(Tt(r.options.server.url,r.options.server.revert),n("GET_FORCE_REVERT")).then(function(){(r.options.instantUpload||function(e){return!ht(e.file)}(t))&&e("REMOVE_ITEM",{query:t.id})}).catch(function(){})}),SET_OPTIONS:function(n){var r=n.options;t(r,function(t,n){e("SET_"+Z(t,"_").toUpperCase(),{value:n})})}}},Mt=function(e){return e},wt=function(e){return document.createElement(e)},Ct=function(e,t){var n=e.childNodes[0];n?t!==n.nodeValue&&(n.nodeValue=t):(n=document.createTextNode(t),e.appendChild(n))},Nt=function(e,t,n,r){var o=(r%360-90)*Math.PI/180;return{x:e+n*Math.cos(o),y:t+n*Math.sin(o)}},Gt=function(e,t,n,r,o){var i=1;return o>r&&o-r<=.5&&(i=0),r>o&&r-o>=.5&&(i=0),function(e,t,n,r,o,i){var a=Nt(e,t,n,o),u=Nt(e,t,n,r);return["M",a.x,a.y,"A",n,n,0,i,0,u.x,u.y].join(" ")}(e,t,n,360*Math.min(.9999,r),360*Math.min(.9999,o),i)},Ut=S({tag:"div",name:"progress-indicator",ignoreRectUpdate:!0,ignoreRect:!0,create:function(e){var t=e.root,n=e.props;n.spin=!1,n.progress=0,n.opacity=0;var r=a("svg");t.ref.path=a("path",{"stroke-width":2,"stroke-linecap":"round"}),r.appendChild(t.ref.path),t.ref.svg=r,t.appendChild(r)},write:function(e){var t=e.root,n=e.props;if(0!==n.opacity){n.align&&(t.element.dataset.align=n.align);var o=parseInt(r(t.ref.path,"stroke-width"),10),i=.5*t.rect.element.width,a=0,u=0;n.spin?(a=0,u=.5):(a=0,u=n.progress);var s=Gt(i,i,i-o,a,u);r(t.ref.path,"d",s),r(t.ref.path,"stroke-opacity",n.spin||n.progress>0?1:0)}},mixins:{apis:["progress","spin","align"],styles:["opacity"],animations:{opacity:{type:"tween",duration:500},progress:{type:"spring",stiffness:.95,damping:.65,mass:10}}}}),Bt=S({tag:"button",attributes:{type:"button"},ignoreRect:!0,ignoreRectUpdate:!0,name:"file-action-button",mixins:{apis:["label"],styles:["translateX","translateY","scaleX","scaleY","opacity"],animations:{scaleX:"spring",scaleY:"spring",translateX:"spring",translateY:"spring",opacity:{type:"tween",duration:250}},listeners:!0},create:function(e){var t=e.root,n=e.props;t.element.innerHTML=(n.icon||"")+"<span>"+n.label+"</span>",n.isDisabled=!1},write:function(e){var t=e.root,n=e.props,o=n.isDisabled,i=t.query("GET_DISABLED")||0===n.opacity;i&&!o?(n.isDisabled=!0,r(t.element,"disabled","disabled")):!i&&o&&(n.isDisabled=!1,t.element.removeAttribute("disabled"))}}),qt=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:".",n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:1e3,r=n,o=n*n,i=n*n*n;return(e=Math.round(Math.abs(e)))<r?e+" bytes":e<o?Math.floor(e/r)+" KB":e<i?Ft(e/o,1,t)+" MB":Ft(e/i,2,t)+" GB"},Ft=function(e,t,n){return e.toFixed(t).split(".").filter(function(e){return"0"!==e}).join(n)},Vt=function(e){var t=e.root,n=e.props;Ct(t.ref.fileSize,qt(t.query("GET_ITEM_SIZE",n.id),".",t.query("GET_FILE_SIZE_BASE"))),Ct(t.ref.fileName,Mt(t.query("GET_ITEM_NAME",n.id)))},xt=function(e){var t=e.root,n=e.props;V(t.query("GET_ITEM_SIZE",n.id))||Ct(t.ref.fileSize,t.query("GET_LABEL_FILE_SIZE_NOT_AVAILABLE"))},Yt=S({name:"file-info",ignoreRect:!0,ignoreRectUpdate:!0,write:A({DID_LOAD_ITEM:Vt,DID_UPDATE_ITEM_META:Vt,DID_THROW_ITEM_LOAD_ERROR:xt,DID_THROW_ITEM_INVALID:xt}),didCreateView:function(e){De("CREATE_VIEW",Object.assign({},e,{view:e}))},create:function(e){var t=e.root,n=e.props,o=wt("span");o.className="filepond--file-info-main",r(o,"aria-hidden","true"),t.appendChild(o),t.ref.fileName=o;var i=wt("span");i.className="filepond--file-info-sub",t.appendChild(i),t.ref.fileSize=i,Ct(i,t.query("GET_LABEL_FILE_WAITING_FOR_SIZE")),Ct(o,Mt(t.query("GET_ITEM_NAME",n.id)))},mixins:{styles:["translateX","translateY"],animations:{translateX:"spring",translateY:"spring"}}}),jt=function(e){return Math.round(100*e)},kt=function(e){var t=e.root,n=e.action,r=null===n.progress?t.query("GET_LABEL_FILE_LOADING"):t.query("GET_LABEL_FILE_LOADING")+" "+jt(n.progress)+"%";Ct(t.ref.main,r),Ct(t.ref.sub,t.query("GET_LABEL_TAP_TO_CANCEL"))},Ht=function(e){var t=e.root;Ct(t.ref.main,""),Ct(t.ref.sub,"")},Xt=function(e){var t=e.root,n=e.action;Ct(t.ref.main,n.status.main),Ct(t.ref.sub,n.status.sub)},Wt=S({name:"file-status",ignoreRect:!0,ignoreRectUpdate:!0,write:A({DID_LOAD_ITEM:Ht,DID_REVERT_ITEM_PROCESSING:Ht,DID_REQUEST_ITEM_PROCESSING:function(e){var t=e.root;Ct(t.ref.main,t.query("GET_LABEL_FILE_PROCESSING")),Ct(t.ref.sub,t.query("GET_LABEL_TAP_TO_CANCEL"))},DID_ABORT_ITEM_PROCESSING:function(e){var t=e.root;Ct(t.ref.main,t.query("GET_LABEL_FILE_PROCESSING_ABORTED")),Ct(t.ref.sub,t.query("GET_LABEL_TAP_TO_RETRY"))},DID_COMPLETE_ITEM_PROCESSING:function(e){var t=e.root;Ct(t.ref.main,t.query("GET_LABEL_FILE_PROCESSING_COMPLETE")),Ct(t.ref.sub,t.query("GET_LABEL_TAP_TO_UNDO"))},DID_UPDATE_ITEM_PROCESS_PROGRESS:function(e){var t=e.root,n=e.action,r=null===n.progress?t.query("GET_LABEL_FILE_PROCESSING"):t.query("GET_LABEL_FILE_PROCESSING")+" "+jt(n.progress)+"%";Ct(t.ref.main,r),Ct(t.ref.sub,t.query("GET_LABEL_TAP_TO_CANCEL"))},DID_UPDATE_ITEM_LOAD_PROGRESS:kt,DID_THROW_ITEM_LOAD_ERROR:Xt,DID_THROW_ITEM_INVALID:Xt,DID_THROW_ITEM_PROCESSING_ERROR:Xt,DID_THROW_ITEM_PROCESSING_REVERT_ERROR:Xt,DID_THROW_ITEM_REMOVE_ERROR:Xt}),didCreateView:function(e){De("CREATE_VIEW",Object.assign({},e,{view:e}))},create:function(e){var t=e.root,n=wt("span");n.className="filepond--file-status-main",t.appendChild(n),t.ref.main=n;var r=wt("span");r.className="filepond--file-status-sub",t.appendChild(r),t.ref.sub=r,kt({root:t,action:{progress:null}})},mixins:{styles:["translateX","translateY","opacity"],animations:{opacity:{type:"tween",duration:250},translateX:"spring",translateY:"spring"}}}),zt={AbortItemLoad:{label:"GET_LABEL_BUTTON_ABORT_ITEM_LOAD",action:"ABORT_ITEM_LOAD",className:"filepond--action-abort-item-load",align:"LOAD_INDICATOR_POSITION"},RetryItemLoad:{label:"GET_LABEL_BUTTON_RETRY_ITEM_LOAD",action:"RETRY_ITEM_LOAD",icon:"GET_ICON_RETRY",className:"filepond--action-retry-item-load",align:"BUTTON_PROCESS_ITEM_POSITION"},RemoveItem:{label:"GET_LABEL_BUTTON_REMOVE_ITEM",action:"REQUEST_REMOVE_ITEM",icon:"GET_ICON_REMOVE",className:"filepond--action-remove-item",align:"BUTTON_REMOVE_ITEM_POSITION"},ProcessItem:{label:"GET_LABEL_BUTTON_PROCESS_ITEM",action:"REQUEST_ITEM_PROCESSING",icon:"GET_ICON_PROCESS",className:"filepond--action-process-item",align:"BUTTON_PROCESS_ITEM_POSITION"},AbortItemProcessing:{label:"GET_LABEL_BUTTON_ABORT_ITEM_PROCESSING",action:"ABORT_ITEM_PROCESSING",className:"filepond--action-abort-item-processing",align:"BUTTON_PROCESS_ITEM_POSITION"},RetryItemProcessing:{label:"GET_LABEL_BUTTON_RETRY_ITEM_PROCESSING",action:"RETRY_ITEM_PROCESSING",icon:"GET_ICON_RETRY",className:"filepond--action-retry-item-processing",align:"BUTTON_PROCESS_ITEM_POSITION"},RevertItemProcessing:{label:"GET_LABEL_BUTTON_UNDO_ITEM_PROCESSING",action:"REQUEST_REVERT_ITEM_PROCESSING",icon:"GET_ICON_UNDO",className:"filepond--action-revert-item-processing",align:"BUTTON_PROCESS_ITEM_POSITION"}},Qt=[];t(zt,function(e){Qt.push(e)});var Zt,$t=function(e){if("right"===tn(e))return 0;var t=e.ref.buttonRemoveItem.rect.element;return t.hidden?null:t.width+t.left},Kt=function(e){return e.ref.buttonAbortItemLoad.rect.element.width},Jt=function(e){return Math.floor(e.ref.buttonRemoveItem.rect.element.height/4)},en=function(e){return Math.floor(e.ref.buttonRemoveItem.rect.element.left/2)},tn=function(e){return e.query("GET_STYLE_BUTTON_REMOVE_ITEM_POSITION")},nn={buttonAbortItemLoad:{opacity:0},buttonRetryItemLoad:{opacity:0},buttonRemoveItem:{opacity:0},buttonProcessItem:{opacity:0},buttonAbortItemProcessing:{opacity:0},buttonRetryItemProcessing:{opacity:0},buttonRevertItemProcessing:{opacity:0},loadProgressIndicator:{opacity:0,align:function(e){return e.query("GET_STYLE_LOAD_INDICATOR_POSITION")}},processProgressIndicator:{opacity:0,align:function(e){return e.query("GET_STYLE_PROGRESS_INDICATOR_POSITION")}},processingCompleteIndicator:{opacity:0,scaleX:.75,scaleY:.75},info:{translateX:0,translateY:0,opacity:0},status:{translateX:0,translateY:0,opacity:0}},rn={buttonRemoveItem:{opacity:1},buttonProcessItem:{opacity:1},info:{translateX:$t},status:{translateX:$t}},on={buttonAbortItemProcessing:{opacity:1},processProgressIndicator:{opacity:1},status:{opacity:1}},an={DID_THROW_ITEM_INVALID:{buttonRemoveItem:{opacity:1},info:{translateX:$t},status:{translateX:$t,opacity:1}},DID_START_ITEM_LOAD:{buttonAbortItemLoad:{opacity:1},loadProgressIndicator:{opacity:1},status:{opacity:1}},DID_THROW_ITEM_LOAD_ERROR:{buttonRetryItemLoad:{opacity:1},buttonRemoveItem:{opacity:1},info:{translateX:$t},status:{opacity:1}},DID_START_ITEM_REMOVE:{processProgressIndicator:{opacity:1,align:tn},info:{translateX:$t},status:{opacity:0}},DID_THROW_ITEM_REMOVE_ERROR:{processProgressIndicator:{opacity:0,align:tn},buttonRemoveItem:{opacity:1},info:{translateX:$t},status:{opacity:1,translateX:$t}},DID_LOAD_ITEM:rn,DID_LOAD_LOCAL_ITEM:{buttonRemoveItem:{opacity:1},info:{translateX:$t},status:{translateX:$t}},DID_START_ITEM_PROCESSING:on,DID_REQUEST_ITEM_PROCESSING:on,DID_UPDATE_ITEM_PROCESS_PROGRESS:on,DID_COMPLETE_ITEM_PROCESSING:{buttonRevertItemProcessing:{opacity:1},info:{opacity:1},status:{opacity:1}},DID_THROW_ITEM_PROCESSING_ERROR:{buttonRemoveItem:{opacity:1},buttonRetryItemProcessing:{opacity:1},status:{opacity:1},info:{translateX:$t}},DID_THROW_ITEM_PROCESSING_REVERT_ERROR:{buttonRevertItemProcessing:{opacity:1},status:{opacity:1},info:{opacity:1}},DID_ABORT_ITEM_PROCESSING:{buttonRemoveItem:{opacity:1},buttonProcessItem:{opacity:1},info:{translateX:$t},status:{opacity:1}},DID_REVERT_ITEM_PROCESSING:rn},un=S({create:function(e){var t=e.root;t.element.innerHTML=t.query("GET_ICON_DONE")},name:"processing-complete-indicator",ignoreRect:!0,mixins:{styles:["scaleX","scaleY","opacity"],animations:{scaleX:"spring",scaleY:"spring",opacity:{type:"tween",duration:250}}}}),sn=A({DID_SET_LABEL_BUTTON_ABORT_ITEM_PROCESSING:function(e){var t=e.root,n=e.action;t.ref.buttonAbortItemProcessing.label=n.value},DID_SET_LABEL_BUTTON_ABORT_ITEM_LOAD:function(e){var t=e.root,n=e.action;t.ref.buttonAbortItemLoad.label=n.value},DID_SET_LABEL_BUTTON_ABORT_ITEM_REMOVAL:function(e){var t=e.root,n=e.action;t.ref.buttonAbortItemRemoval.label=n.value},DID_REQUEST_ITEM_PROCESSING:function(e){var t=e.root;t.ref.processProgressIndicator.spin=!0,t.ref.processProgressIndicator.progress=0},DID_START_ITEM_LOAD:function(e){var t=e.root;t.ref.loadProgressIndicator.spin=!0,t.ref.loadProgressIndicator.progress=0},DID_START_ITEM_REMOVE:function(e){var t=e.root;t.ref.processProgressIndicator.spin=!0,t.ref.processProgressIndicator.progress=0},DID_UPDATE_ITEM_LOAD_PROGRESS:function(e){var t=e.root,n=e.action;t.ref.loadProgressIndicator.spin=!1,t.ref.loadProgressIndicator.progress=n.progress},DID_UPDATE_ITEM_PROCESS_PROGRESS:function(e){var t=e.root,n=e.action;t.ref.processProgressIndicator.spin=!1,t.ref.processProgressIndicator.progress=n.progress}}),ln=S({create:function(e){var n,r=e.root,o=e.props,i=Object.keys(zt).reduce(function(e,t){return e[t]=Object.assign({},zt[t]),e},{}),a=o.id,u=r.query("GET_ALLOW_REVERT"),s=r.query("GET_ALLOW_REMOVE"),l=r.query("GET_ALLOW_PROCESS"),c=r.query("GET_INSTANT_UPLOAD"),f=r.query("IS_ASYNC"),d=r.query("GET_STYLE_BUTTON_REMOVE_ITEM_ALIGN");f?l&&!u?n=function(e){return!/RevertItemProcessing/.test(e)}:!l&&u?n=function(e){return!/ProcessItem|RetryItemProcessing|AbortItemProcessing/.test(e)}:l||u||(n=function(e){return!/Process/.test(e)}):n=function(e){return!/Process/.test(e)};var p=n?Qt.filter(n):Qt.concat();if(c&&u&&(i.RevertItemProcessing.label="GET_LABEL_BUTTON_REMOVE_ITEM",i.RevertItemProcessing.icon="GET_ICON_REMOVE"),f&&!u){var E=an.DID_COMPLETE_ITEM_PROCESSING;E.info.translateX=en,E.info.translateY=Jt,E.status.translateY=Jt,E.processingCompleteIndicator={opacity:1,scaleX:1,scaleY:1}}if(f&&!l&&(["DID_START_ITEM_PROCESSING","DID_REQUEST_ITEM_PROCESSING","DID_UPDATE_ITEM_PROCESS_PROGRESS","DID_THROW_ITEM_PROCESSING_ERROR"].forEach(function(e){an[e].status.translateY=Jt}),an.DID_THROW_ITEM_PROCESSING_ERROR.status.translateX=Kt),d&&u){i.RevertItemProcessing.align="BUTTON_REMOVE_ITEM_POSITION";var _=an.DID_COMPLETE_ITEM_PROCESSING;_.info.translateX=$t,_.status.translateY=Jt,_.processingCompleteIndicator={opacity:1,scaleX:1,scaleY:1}}s||(i.RemoveItem.disabled=!0),t(i,function(e,t){var n=r.createChildView(Bt,{label:r.query(t.label),icon:r.query(t.icon),opacity:0});p.includes(e)&&r.appendChildView(n),t.disabled&&(n.element.setAttribute("disabled","disabled"),n.element.setAttribute("hidden","hidden")),n.element.dataset.align=r.query("GET_STYLE_"+t.align),n.element.classList.add(t.className),n.on("click",function(e){e.stopPropagation(),t.disabled||r.dispatch(t.action,{query:a})}),r.ref["button"+e]=n}),r.ref.processingCompleteIndicator=r.appendChildView(r.createChildView(un)),r.ref.processingCompleteIndicator.element.dataset.align=r.query("GET_STYLE_BUTTON_PROCESS_ITEM_POSITION"),r.ref.info=r.appendChildView(r.createChildView(Yt,{id:a})),r.ref.status=r.appendChildView(r.createChildView(Wt,{id:a}));var T=r.appendChildView(r.createChildView(Ut,{opacity:0,align:r.query("GET_STYLE_LOAD_INDICATOR_POSITION")}));T.element.classList.add("filepond--load-indicator"),r.ref.loadProgressIndicator=T;var I=r.appendChildView(r.createChildView(Ut,{opacity:0,align:r.query("GET_STYLE_PROGRESS_INDICATOR_POSITION")}));I.element.classList.add("filepond--process-indicator"),r.ref.processProgressIndicator=I,r.ref.activeStyles=[]},write:function(e){var n=e.root,r=e.actions,o=e.props;sn({root:n,actions:r,props:o});var i=r.concat().filter(function(e){return/^DID_/.test(e.type)}).reverse().find(function(e){return an[e.type]});if(i){n.ref.activeStyles=[];var a=an[i.type];t(nn,function(e,r){var o=n.ref[e];t(r,function(t,r){var i=a[e]&&void 0!==a[e][t]?a[e][t]:r;n.ref.activeStyles.push({control:o,key:t,value:i})})})}n.ref.activeStyles.forEach(function(e){var t=e.control,r=e.key,o=e.value;t[r]="function"==typeof o?o(n):o})},didCreateView:function(e){De("CREATE_VIEW",Object.assign({},e,{view:e}))},name:"file"}),cn=S({create:function(e){var t=e.root,n=e.props;t.ref.fileName=wt("legend"),t.appendChild(t.ref.fileName),t.ref.file=t.appendChildView(t.createChildView(ln,{id:n.id})),t.ref.data=!1},ignoreRect:!0,write:A({DID_LOAD_ITEM:function(e){var t=e.root,n=e.props;Ct(t.ref.fileName,Mt(t.query("GET_ITEM_NAME",n.id)))}}),didCreateView:function(e){De("CREATE_VIEW",Object.assign({},e,{view:e}))},tag:"fieldset",name:"file-wrapper"}),fn={type:"spring",damping:.6,mass:7},dn=function(e,t,n){var r=S({name:"panel-"+t.name+" filepond--"+n,mixins:t.mixins,ignoreRectUpdate:!0}),o=e.createChildView(r,t.props);e.ref[t.name]=e.appendChildView(o)},pn=S({name:"panel",read:function(e){var t=e.root;return e.props.heightCurrent=t.ref.bottom.translateY},write:function(e){var t=e.root,n=e.props;if(null!==t.ref.scalable&&n.scalable===t.ref.scalable||(t.ref.scalable=!N(n.scalable)||n.scalable,t.element.dataset.scalable=t.ref.scalable),n.height){var r=t.ref.top.rect.element,o=t.ref.bottom.rect.element,i=Math.max(r.height+o.height,n.height);t.ref.center.translateY=r.height,t.ref.center.scaleY=(i-r.height-o.height)/100,t.ref.bottom.translateY=i-o.height}},create:function(e){var t=e.root,n=e.props;[{name:"top"},{name:"center",props:{translateY:null,scaleY:null},mixins:{animations:{scaleY:fn},styles:["translateY","scaleY"]}},{name:"bottom",props:{translateY:null},mixins:{animations:{translateY:fn},styles:["translateY"]}}].forEach(function(e){dn(t,e,n.name)}),t.element.classList.add("filepond--"+n.name),t.ref.scalable=null},ignoreRect:!0,mixins:{apis:["height","heightCurrent","scalable"]}}),En={type:"spring",stiffness:.75,damping:.45,mass:10},_n={DID_START_ITEM_LOAD:"busy",DID_UPDATE_ITEM_LOAD_PROGRESS:"loading",DID_THROW_ITEM_INVALID:"load-invalid",DID_THROW_ITEM_LOAD_ERROR:"load-error",DID_LOAD_ITEM:"idle",DID_THROW_ITEM_REMOVE_ERROR:"remove-error",DID_START_ITEM_REMOVE:"busy",DID_START_ITEM_PROCESSING:"busy processing",DID_REQUEST_ITEM_PROCESSING:"busy processing",DID_UPDATE_ITEM_PROCESS_PROGRESS:"processing",DID_COMPLETE_ITEM_PROCESSING:"processing-complete",DID_THROW_ITEM_PROCESSING_ERROR:"processing-error",DID_THROW_ITEM_PROCESSING_REVERT_ERROR:"processing-revert-error",DID_ABORT_ITEM_PROCESSING:"cancelled",DID_REVERT_ITEM_PROCESSING:"idle"},Tn=A({DID_UPDATE_PANEL_HEIGHT:function(e){var t=e.root,n=e.action;t.height=n.height}}),In=A({DID_GRAB_ITEM:function(e){var t=e.root;e.props.dragOrigin={x:t.translateX,y:t.translateY}},DID_DRAG_ITEM:function(e){e.root.element.dataset.dragState="drag"},DID_DROP_ITEM:function(e){var t=e.root,n=e.props;n.dragOffset=null,n.dragOrigin=null,t.element.dataset.dragState="drop"}},function(e){var t=e.root,n=e.actions,r=e.props,o=e.shouldOptimize;"drop"===t.element.dataset.dragState&&t.scaleX<=1&&(t.element.dataset.dragState="idle");var i=n.concat().filter(function(e){return/^DID_/.test(e.type)}).reverse().find(function(e){return _n[e.type]});i&&i.type!==r.currentState&&(r.currentState=i.type,t.element.dataset.filepondItemState=_n[r.currentState]||"");var a=t.query("GET_ITEM_PANEL_ASPECT_RATIO")||t.query("GET_PANEL_ASPECT_RATIO");a?o||(t.height=t.rect.element.width*a):(Tn({root:t,actions:n,props:r}),!t.height&&t.ref.container.rect.element.height>0&&(t.height=t.ref.container.rect.element.height)),o&&(t.ref.panel.height=null),t.ref.panel.height=t.height}),vn=S({create:function(e){var t=e.root,n=e.props;t.ref.handleClick=function(e){return t.dispatch("DID_ACTIVATE_ITEM",{id:n.id})},t.element.id="filepond--item-"+n.id,t.element.addEventListener("click",t.ref.handleClick),t.ref.container=t.appendChildView(t.createChildView(cn,{id:n.id})),t.ref.panel=t.appendChildView(t.createChildView(pn,{name:"item-panel"})),t.ref.panel.height=null,n.markedForRemoval=!1,t.query("GET_ALLOW_REORDER")&&(t.element.dataset.dragState="idle",t.element.addEventListener("pointerdown",function(e){if(e.isPrimary){var r=!1,o=e.pageX,i=e.pageY;n.dragOrigin={x:t.translateX,y:t.translateY},n.dragCenter={x:e.offsetX,y:e.offsetY};var a,u,s,l=(a=t.query("GET_ACTIVE_ITEMS"),u=a.map(function(e){return e.id}),s=void 0,{setIndex:function(e){s=e},getIndex:function(){return s},getItemIndex:function(e){return u.indexOf(e.id)}});t.dispatch("DID_GRAB_ITEM",{id:n.id,dragState:l});var c=function(e){e.isPrimary&&(e.stopPropagation(),e.preventDefault(),n.dragOffset={x:e.pageX-o,y:e.pageY-i},n.dragOffset.x*n.dragOffset.x+n.dragOffset.y*n.dragOffset.y>16&&!r&&(r=!0,t.element.removeEventListener("click",t.ref.handleClick)),t.dispatch("DID_DRAG_ITEM",{id:n.id,dragState:l}))};document.addEventListener("pointermove",c),document.addEventListener("pointerup",function e(a){a.isPrimary&&(document.removeEventListener("pointermove",c),document.removeEventListener("pointerup",e),n.dragOffset={x:a.pageX-o,y:a.pageY-i},t.dispatch("DID_DROP_ITEM",{id:n.id,dragState:l}),r&&setTimeout(function(){return t.element.addEventListener("click",t.ref.handleClick)},0))})}}))},write:In,destroy:function(e){var t=e.root,n=e.props;t.element.removeEventListener("click",t.ref.handleClick),t.dispatch("RELEASE_ITEM",{query:n.id})},tag:"li",name:"item",mixins:{apis:["id","interactionMethod","markedForRemoval","spawnDate","dragCenter","dragOrigin","dragOffset"],styles:["translateX","translateY","scaleX","scaleY","opacity","height"],animations:{scaleX:"spring",scaleY:"spring",translateX:En,translateY:En,opacity:{type:"tween",duration:150}}}}),mn=function(e,t){return Math.max(1,Math.floor((e+1)/t))},hn=function(e,t,n){if(n){var r=e.rect.element.width,o=t.length,i=null;if(0===o||n.top<t[0].rect.element.top)return-1;var a=t[0].rect.element,u=a.marginLeft+a.marginRight,s=a.width+u,l=mn(r,s);if(1===l){for(var c=0;c<o;c++){var f=t[c],d=f.rect.outer.top+.5*f.rect.element.height;if(n.top<d)return c}return o}for(var p=a.marginTop+a.marginBottom,E=a.height+p,_=0;_<o;_++){var T=_%l*s,I=Math.floor(_/l)*E,v=I-a.marginTop,m=T+s,h=I+E+a.marginBottom;if(n.top<h&&n.top>v){if(n.left<m)return _;i=_!==o-1?_:null}}return null!==i?i:o}},gn={height:0,width:0,get getHeight(){return this.height},set setHeight(e){0!==this.height&&0!==e||(this.height=e)},get getWidth(){return this.width},set setWidth(e){0!==this.width&&0!==e||(this.width=e)},setDimensions:function(e,t){0!==this.height&&0!==e||(this.height=e),0!==this.width&&0!==t||(this.width=t)}},Rn=function(e,t,n){var r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:0,o=arguments.length>4&&void 0!==arguments[4]?arguments[4]:1;e.dragOffset?(e.translateX=null,e.translateY=null,e.translateX=e.dragOrigin.x+e.dragOffset.x,e.translateY=e.dragOrigin.y+e.dragOffset.y,e.scaleX=1.025,e.scaleY=1.025):(e.translateX=t,e.translateY=n,Date.now()>e.spawnDate&&(0===e.opacity&&On(e,t,n,r,o),e.scaleX=1,e.scaleY=1,e.opacity=1))},On=function(e,t,n,r,o){e.interactionMethod===re?(e.translateX=null,e.translateX=t,e.translateY=null,e.translateY=n):e.interactionMethod===ee?(e.translateX=null,e.translateX=t-20*r,e.translateY=null,e.translateY=n-10*o,e.scaleX=.8,e.scaleY=.8):e.interactionMethod===te?(e.translateY=null,e.translateY=n-30):e.interactionMethod===J&&(e.translateX=null,e.translateX=t-30,e.translateY=null)},Dn=function(e){return e.rect.element.height+.5*e.rect.element.marginBottom+.5*e.rect.element.marginTop},yn=A({DID_ADD_ITEM:function(e){var t=e.root,n=e.action,r=n.id,o=n.index,i=n.interactionMethod;t.ref.addIndex=o;var a=Date.now(),u=a,s=1;if(i!==re){s=0;var l=t.query("GET_ITEM_INSERT_INTERVAL"),c=a-t.ref.lastItemSpanwDate;u=c<l?a+(l-c):a}t.ref.lastItemSpanwDate=u,t.appendChildView(t.createChildView(vn,{spawnDate:u,id:r,opacity:s,interactionMethod:i}),o)},DID_REMOVE_ITEM:function(e){var t=e.root,n=e.action.id,r=t.childViews.find(function(e){return e.id===n});r&&(r.scaleX=.9,r.scaleY=.9,r.opacity=0,r.markedForRemoval=!0)},DID_DRAG_ITEM:function(e){var t=e.root,n=e.action,r=n.id,o=n.dragState,i=t.query("GET_ITEM",{id:r}),a=t.childViews.find(function(e){return e.id===r}),u=t.childViews.length,s=o.getItemIndex(i);if(a){var l,c=a.dragOrigin.x+a.dragOffset.x+a.dragCenter.x,f=a.dragOrigin.y+a.dragOffset.y+a.dragCenter.y,d=Dn(a),p=(l=a).rect.element.width+.5*l.rect.element.marginLeft+.5*l.rect.element.marginRight,E=Math.floor(t.rect.outer.width/p);E>u&&(E=u);var _=Math.floor(u/E+1);gn.setHeight=d*_,gn.setWidth=p*E;var T={y:Math.floor(f/d),x:Math.floor(c/p),getGridIndex:function(){return f>gn.getHeight||f<0||c>gn.getWidth||c<0?s:this.y*E+this.x},getColIndex:function(){for(var e=t.query("GET_ACTIVE_ITEMS"),n=t.childViews.filter(function(e){return e.rect.element.height}),r=e.map(function(e){return n.find(function(t){return t.id===e.id})}),o=r.findIndex(function(e){return e===a}),i=Dn(a),u=r.length,s=u,l=0,c=0,d=0,p=0;p<u;p++)if(l=Dn(r[p]),f<(c=(d=c)+l)){if(o>p){if(f<d+i){s=p;break}continue}s=p;break}return s}},I=E>1?T.getGridIndex():T.getColIndex();t.dispatch("MOVE_ITEM",{query:a,index:I});var v=o.getIndex();if(void 0===v||v!==I){if(o.setIndex(I),void 0===v)return;t.dispatch("DID_REORDER_ITEMS",{items:t.query("GET_ACTIVE_ITEMS"),origin:s,target:I})}}}}),Sn=S({create:function(e){var t=e.root;r(t.element,"role","list"),t.ref.lastItemSpanwDate=Date.now()},write:function(e){var t=e.root,n=e.props,r=e.actions,o=e.shouldOptimize;yn({root:t,props:n,actions:r});var i=n.dragCoordinates,a=t.rect.element.width,u=t.childViews.filter(function(e){return e.rect.element.height}),s=t.query("GET_ACTIVE_ITEMS").map(function(e){return u.find(function(t){return t.id===e.id})}).filter(function(e){return e}),l=i?hn(t,s,i):null,c=t.ref.addIndex||null;t.ref.addIndex=null;var f=0,d=0,p=0;if(0!==s.length){var E=s[0].rect.element,_=E.marginTop+E.marginBottom,T=E.marginLeft+E.marginRight,I=E.width+T,v=E.height+_,m=mn(a,I);if(1===m){var h=0,g=0;s.forEach(function(e,t){if(l){var n=t-l;g=-2===n?.25*-_:-1===n?.75*-_:0===n?.75*_:1===n?.25*_:0}o&&(e.translateX=null,e.translateY=null),e.markedForRemoval||Rn(e,0,h+g);var r=(e.rect.element.height+_)*(e.markedForRemoval?e.opacity:1);h+=r})}else{var R=0,O=0;s.forEach(function(e,t){t===l&&(f=1),t===c&&(p+=1),e.markedForRemoval&&e.opacity<.5&&(d-=1);var n=t+p+f+d,r=n%m,i=Math.floor(n/m),a=r*I,u=i*v,s=Math.sign(a-R),E=Math.sign(u-O);R=a,O=u,e.markedForRemoval||(o&&(e.translateX=null,e.translateY=null),Rn(e,a,u,s,E))})}}},tag:"ul",name:"list",didWriteView:function(e){var t=e.root;t.childViews.filter(function(e){return e.markedForRemoval&&0===e.opacity&&e.resting}).forEach(function(e){e._destroy(),t.removeChildView(e)})},filterFrameActionsForChild:function(e,t){return t.filter(function(t){return!t.data||!t.data.id||e.id===t.data.id})},mixins:{apis:["dragCoordinates"]}}),An=A({DID_DRAG:function(e){var t=e.root,n=e.props,r=e.action;t.query("GET_ITEM_INSERT_LOCATION_FREEDOM")&&(n.dragCoordinates={left:r.position.scopeLeft-t.ref.list.rect.element.left,top:r.position.scopeTop-(t.rect.outer.top+t.rect.element.marginTop+t.rect.element.scrollTop)})},DID_END_DRAG:function(e){e.props.dragCoordinates=null}}),Ln=S({create:function(e){var t=e.root,n=e.props;t.ref.list=t.appendChildView(t.createChildView(Sn)),n.dragCoordinates=null,n.overflowing=!1},write:function(e){var t=e.root,n=e.props,r=e.actions;if(An({root:t,props:n,actions:r}),t.ref.list.dragCoordinates=n.dragCoordinates,n.overflowing&&!n.overflow&&(n.overflowing=!1,t.element.dataset.state="",t.height=null),n.overflow){var o=Math.round(n.overflow);o!==t.height&&(n.overflowing=!0,t.element.dataset.state="overflow",t.height=o)}},name:"list-scroller",mixins:{apis:["overflow","dragCoordinates"],styles:["height","translateY"],animations:{translateY:"spring"}}}),Pn=function(e,t,n){var o=arguments.length>3&&void 0!==arguments[3]?arguments[3]:"";n?r(e,t,o):e.removeAttribute(t)},bn=function(e){var t=e.root,n=e.action;t.query("GET_ALLOW_SYNC_ACCEPT_ATTRIBUTE")&&Pn(t.element,"accept",!!n.value,n.value?n.value.join(","):"")},Mn=function(e){var t=e.root,n=e.action;Pn(t.element,"multiple",n.value)},wn=function(e){var t=e.root,n=e.action;Pn(t.element,"webkitdirectory",n.value)},Cn=function(e){var t=e.root,n=t.query("GET_DISABLED"),r=t.query("GET_ALLOW_BROWSE"),o=n||!r;Pn(t.element,"disabled",o)},Nn=function(e){var t=e.root;e.action.value?0===t.query("GET_TOTAL_ITEMS")&&Pn(t.element,"required",!0):Pn(t.element,"required",!1)},Gn=function(e){var t=e.root,n=e.action;Pn(t.element,"capture",!!n.value,!0===n.value?"":n.value)},Un=function(e){var t=e.root,n=t.element;t.query("GET_TOTAL_ITEMS")>0?(Pn(n,"required",!1),Pn(n,"name",!1)):(Pn(n,"name",!0,t.query("GET_NAME")),t.query("GET_CHECK_VALIDITY")&&n.setCustomValidity(""),t.query("GET_REQUIRED")&&Pn(n,"required",!0))},Bn=S({tag:"input",name:"browser",ignoreRect:!0,ignoreRectUpdate:!0,attributes:{type:"file"},create:function(e){var t=e.root,n=e.props;t.element.id="filepond--browser-"+n.id,r(t.element,"name",t.query("GET_NAME")),r(t.element,"aria-controls","filepond--assistant-"+n.id),r(t.element,"aria-labelledby","filepond--drop-label-"+n.id),bn({root:t,action:{value:t.query("GET_ACCEPTED_FILE_TYPES")}}),Mn({root:t,action:{value:t.query("GET_ALLOW_MULTIPLE")}}),wn({root:t,action:{value:t.query("GET_ALLOW_DIRECTORIES_ONLY")}}),Cn({root:t}),Nn({root:t,action:{value:t.query("GET_REQUIRED")}}),Gn({root:t,action:{value:t.query("GET_CAPTURE_METHOD")}}),t.ref.handleChange=function(e){if(t.element.value){var r=Array.from(t.element.files).map(function(e){return e._relativePath=e.webkitRelativePath,e});setTimeout(function(){n.onload(r),function(e){if(e&&""!==e.value){try{e.value=""}catch(e){}if(e.value){var t=wt("form"),n=e.parentNode,r=e.nextSibling;t.appendChild(e),t.reset(),r?n.insertBefore(e,r):n.appendChild(e)}}}(t.element)},250)}},t.element.addEventListener("change",t.ref.handleChange)},destroy:function(e){var t=e.root;t.element.removeEventListener("change",t.ref.handleChange)},write:A({DID_LOAD_ITEM:Un,DID_REMOVE_ITEM:Un,DID_THROW_ITEM_INVALID:function(e){var t=e.root;t.query("GET_CHECK_VALIDITY")&&t.element.setCustomValidity(t.query("GET_LABEL_INVALID_FIELD"))},DID_SET_DISABLED:Cn,DID_SET_ALLOW_BROWSE:Cn,DID_SET_ALLOW_DIRECTORIES_ONLY:wn,DID_SET_ALLOW_MULTIPLE:Mn,DID_SET_ACCEPTED_FILE_TYPES:bn,DID_SET_CAPTURE_METHOD:Gn,DID_SET_REQUIRED:Nn})}),qn=13,Fn=32,Vn=function(e,t){e.innerHTML=t;var n=e.querySelector(".filepond--label-action");return n&&r(n,"tabindex","0"),t},xn=S({name:"drop-label",ignoreRect:!0,create:function(e){var t=e.root,n=e.props,o=wt("label");r(o,"for","filepond--browser-"+n.id),r(o,"id","filepond--drop-label-"+n.id),r(o,"aria-hidden","true"),t.ref.handleKeyDown=function(e){(e.keyCode===qn||e.keyCode===Fn)&&(e.preventDefault(),t.ref.label.click())},t.ref.handleClick=function(e){e.target===o||o.contains(e.target)||t.ref.label.click()},o.addEventListener("keydown",t.ref.handleKeyDown),t.element.addEventListener("click",t.ref.handleClick),Vn(o,n.caption),t.appendChild(o),t.ref.label=o},destroy:function(e){var t=e.root;t.ref.label.addEventListener("keydown",t.ref.handleKeyDown),t.element.removeEventListener("click",t.ref.handleClick)},write:A({DID_SET_LABEL_IDLE:function(e){var t=e.root,n=e.action;Vn(t.ref.label,n.value)}}),mixins:{styles:["opacity","translateX","translateY"],animations:{opacity:{type:"tween",duration:150},translateX:"spring",translateY:"spring"}}}),Yn=S({name:"drip-blob",ignoreRect:!0,mixins:{styles:["translateX","translateY","scaleX","scaleY","opacity"],animations:{scaleX:"spring",scaleY:"spring",translateX:"spring",translateY:"spring",opacity:{type:"tween",duration:250}}}}),jn=A({DID_DRAG:function(e){var t=e.root,n=e.action;t.ref.blob?(t.ref.blob.translateX=n.position.scopeLeft,t.ref.blob.translateY=n.position.scopeTop,t.ref.blob.scaleX=1,t.ref.blob.scaleY=1,t.ref.blob.opacity=1):function(e){var t=e.root,n=.5*t.rect.element.width,r=.5*t.rect.element.height;t.ref.blob=t.appendChildView(t.createChildView(Yn,{opacity:0,scaleX:2.5,scaleY:2.5,translateX:n,translateY:r}))}({root:t})},DID_DROP:function(e){var t=e.root;t.ref.blob&&(t.ref.blob.scaleX=2.5,t.ref.blob.scaleY=2.5,t.ref.blob.opacity=0)},DID_END_DRAG:function(e){var t=e.root;t.ref.blob&&(t.ref.blob.opacity=0)}}),kn=S({ignoreRect:!0,ignoreRectUpdate:!0,name:"drip",write:function(e){var t=e.root,n=e.props,r=e.actions;jn({root:t,props:n,actions:r});var o=t.ref.blob;0===r.length&&o&&0===o.opacity&&(t.removeChildView(o),t.ref.blob=null)}}),Hn=function(e,t){try{var n=new DataTransfer;t.forEach(function(e){e instanceof File?n.items.add(e):n.items.add(new File([e],e.name,{type:e.type}))}),e.files=n.files}catch(e){return!1}return!0},Xn=function(e,t){return e.ref.fields[t]},Wn=function(e){e.query("GET_ACTIVE_ITEMS").forEach(function(t){e.ref.fields[t.id]&&e.element.appendChild(e.ref.fields[t.id])})},zn=function(e){var t=e.root;return Wn(t)},Qn=A({DID_SET_DISABLED:function(e){var t=e.root;t.element.disabled=t.query("GET_DISABLED")},DID_ADD_ITEM:function(e){var t=e.root,n=e.action,r=!(t.query("GET_ITEM",n.id).origin===ve.LOCAL)&&t.query("SHOULD_UPDATE_FILE_INPUT"),o=wt("input");o.type=r?"file":"hidden",o.name=t.query("GET_NAME"),o.disabled=t.query("GET_DISABLED"),t.ref.fields[n.id]=o,Wn(t)},DID_LOAD_ITEM:function(e){var t=e.root,n=e.action,r=Xn(t,n.id);if(r&&(null!==n.serverFileReference&&(r.value=n.serverFileReference),t.query("SHOULD_UPDATE_FILE_INPUT"))){var o=t.query("GET_ITEM",n.id);Hn(r,[o.file])}},DID_REMOVE_ITEM:function(e){var t=e.root,n=e.action,r=Xn(t,n.id);r&&(r.parentNode&&r.parentNode.removeChild(r),delete t.ref.fields[n.id])},DID_DEFINE_VALUE:function(e){var t=e.root,n=e.action,r=Xn(t,n.id);r&&(null===n.value?r.removeAttribute("value"):r.value=n.value,Wn(t))},DID_PREPARE_OUTPUT:function(e){var t=e.root,n=e.action;t.query("SHOULD_UPDATE_FILE_INPUT")&&setTimeout(function(){var e=Xn(t,n.id);e&&Hn(e,[n.file])},0)},DID_REORDER_ITEMS:zn,DID_SORT_ITEMS:zn}),Zn=S({tag:"fieldset",name:"data",create:function(e){return e.root.ref.fields={}},write:Qn,ignoreRect:!0}),$n=["jpg","jpeg","png","gif","bmp","webp","svg","tiff"],Kn=["css","csv","html","txt"],Jn={zip:"zip|compressed",epub:"application/epub+zip"},er=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";return e=e.toLowerCase(),$n.includes(e)?"image/"+("jpg"===e?"jpeg":"svg"===e?"svg+xml":e):Kn.includes(e)?"text/"+e:Jn[e]||""},tr=function(e){return new Promise(function(t,n){var r=fr(e);if(r.length&&!nr(e))return t(r);rr(e).then(t)})},nr=function(e){return!!e.files&&e.files.length>0},rr=function(e){return new Promise(function(t,n){var r=(e.items?Array.from(e.items):[]).filter(function(e){return or(e)}).map(function(e){return ir(e)});r.length?Promise.all(r).then(function(e){var n=[];e.forEach(function(e){n.push.apply(n,e)}),t(n.filter(function(e){return e}).map(function(e){return e._relativePath||(e._relativePath=e.webkitRelativePath),e}))}).catch(console.error):t(e.files?Array.from(e.files):[])})},or=function(e){if(lr(e)){var t=cr(e);if(t)return t.isFile||t.isDirectory}return"file"===e.kind},ir=function(e){return new Promise(function(t,n){sr(e)?ar(cr(e)).then(t).catch(n):t([e.getAsFile()])})},ar=function(e){return new Promise(function(t,n){var r=[],o=0,i=0,a=function(){0===i&&0===o&&t(r)};!function e(t){o++;var u=t.createReader();!function t(){u.readEntries(function(n){if(0===n.length)return o--,void a();n.forEach(function(t){t.isDirectory?e(t):(i++,t.file(function(e){var n=ur(e);t.fullPath&&(n._relativePath=t.fullPath),r.push(n),i--,a()}))}),t()},n)}()}(e)})},ur=function(e){if(e.type.length)return e;var t=e.lastModifiedDate,n=e.name,r=er(ke(e.name));return r.length?((e=e.slice(0,e.size,r)).name=n,e.lastModifiedDate=t,e):e},sr=function(e){return lr(e)&&(cr(e)||{}).isDirectory},lr=function(e){return"webkitGetAsEntry"in e},cr=function(e){return e.webkitGetAsEntry()},fr=function(e){var t=[];try{if((t=pr(e)).length)return t;t=dr(e)}catch(e){}return t},dr=function(e){var t=e.getData("url");return"string"==typeof t&&t.length?[t]:[]},pr=function(e){var t=e.getData("text/html");if("string"==typeof t&&t.length){var n=t.match(/src\s*=\s*"(.+?)"/);if(n)return[n[1]]}return[]},Er=[],_r=function(e){return{pageLeft:e.pageX,pageTop:e.pageY,scopeLeft:e.offsetX||e.layerX,scopeTop:e.offsetY||e.layerY}},Tr=function(e){var t=Er.find(function(t){return t.element===e});if(t)return t;var n=Ir(e);return Er.push(n),n},Ir=function(e){var n=[],r={dragenter:gr,dragover:Rr,dragleave:Dr,drop:Or},o={};t(r,function(t,r){o[t]=r(e,n),e.addEventListener(t,o[t],!1)});var i={element:e,addListener:function(a){return n.push(a),function(){n.splice(n.indexOf(a),1),0===n.length&&(Er.splice(Er.indexOf(i),1),t(r,function(t){e.removeEventListener(t,o[t],!1)}))}}};return i},vr=function(e,t){var n,r=function(e,t){return"elementFromPoint"in e||(e=document),e.elementFromPoint(t.x,t.y)}("getRootNode"in(n=t)?n.getRootNode():document,{x:e.pageX-window.pageXOffset,y:e.pageY-window.pageYOffset});return r===t||t.contains(r)},mr=null,hr=function(e,t){try{e.dropEffect=t}catch(e){}},gr=function(e,t){return function(e){e.preventDefault(),mr=e.target,t.forEach(function(t){var n=t.element,r=t.onenter;vr(e,n)&&(t.state="enter",r(_r(e)))})}},Rr=function(e,t){return function(e){e.preventDefault();var n=e.dataTransfer;tr(n).then(function(r){var o=!1;t.some(function(t){var i=t.filterElement,a=t.element,u=t.onenter,s=t.onexit,l=t.ondrag,c=t.allowdrop;hr(n,"copy");var f=c(r);if(f)if(vr(e,a)){if(o=!0,null===t.state)return t.state="enter",void u(_r(e));if(t.state="over",i&&!f)return void hr(n,"none");l(_r(e))}else i&&!o&&hr(n,"none"),t.state&&(t.state=null,s(_r(e)));else hr(n,"none")})})}},Or=function(e,t){return function(e){e.preventDefault();var n=e.dataTransfer;tr(n).then(function(n){t.forEach(function(t){var r=t.filterElement,o=t.element,i=t.ondrop,a=t.onexit,u=t.allowdrop;if(t.state=null,!r||vr(e,o))return u(n)?void i(_r(e),n):a(_r(e))})})}},Dr=function(e,t){return function(e){mr===e.target&&t.forEach(function(t){var n=t.onexit;t.state=null,n(_r(e))})}},yr=function(e,t,n){e.classList.add("filepond--hopper");var r=n.catchesDropsOnPage,o=n.requiresDropOnElement,i=n.filterItems,a=void 0===i?function(e){return e}:i,u=function(e,t,n){var r=Tr(t),o={element:e,filterElement:n,state:null,ondrop:function(){},onenter:function(){},ondrag:function(){},onexit:function(){},onload:function(){},allowdrop:function(){}};return o.destroy=r.addListener(o),o}(e,r?document.documentElement:e,o),s="",l="";u.allowdrop=function(e){return t(a(e))},u.ondrop=function(e,n){var r=a(n);t(r)?(l="drag-drop",c.onload(r,e)):c.ondragend(e)},u.ondrag=function(e){c.ondrag(e)},u.onenter=function(e){l="drag-over",c.ondragstart(e)},u.onexit=function(e){l="drag-exit",c.ondragend(e)};var c={updateHopperState:function(){s!==l&&(e.dataset.hopperState=l,s=l)},onload:function(){},ondragstart:function(){},ondrag:function(){},ondragend:function(){},destroy:function(){u.destroy()}};return c},Sr=!1,Ar=[],Lr=function(e){var t=document.activeElement;if(t&&/textarea|input/i.test(t.nodeName)){for(var n=!1,r=t;r!==document.body;){if(r.classList.contains("filepond--root")){n=!0;break}r=r.parentNode}if(!n)return}tr(e.clipboardData).then(function(e){e.length&&Ar.forEach(function(t){return t(e)})})},Pr=function(){var e=function(e){t.onload(e)},t={destroy:function(){var t;t=e,de(Ar,Ar.indexOf(t)),0===Ar.length&&(document.removeEventListener("paste",Lr),Sr=!1)},onload:function(){}};return function(e){Ar.includes(e)||(Ar.push(e),Sr||(Sr=!0,document.addEventListener("paste",Lr)))}(e),t},br=null,Mr=null,wr=[],Cr=function(e,t){e.element.textContent=t},Nr=function(e,t,n){var r=e.query("GET_TOTAL_ITEMS");Cr(e,n+" "+t+", "+r+" "+(1===r?e.query("GET_LABEL_FILE_COUNT_SINGULAR"):e.query("GET_LABEL_FILE_COUNT_PLURAL"))),clearTimeout(Mr),Mr=setTimeout(function(){!function(e){e.element.textContent=""}(e)},1500)},Gr=function(e){return e.element.parentNode.contains(document.activeElement)},Ur=function(e){var t=e.root,n=e.action,r=t.query("GET_ITEM",n.id).filename,o=t.query("GET_LABEL_FILE_PROCESSING_ABORTED");Cr(t,r+" "+o)},Br=function(e){var t=e.root,n=e.action,r=t.query("GET_ITEM",n.id).filename;Cr(t,n.status.main+" "+r+" "+n.status.sub)},qr=S({create:function(e){var t=e.root,n=e.props;t.element.id="filepond--assistant-"+n.id,r(t.element,"role","status"),r(t.element,"aria-live","polite"),r(t.element,"aria-relevant","additions")},ignoreRect:!0,ignoreRectUpdate:!0,write:A({DID_LOAD_ITEM:function(e){var t=e.root,n=e.action;if(Gr(t)){t.element.textContent="";var r=t.query("GET_ITEM",n.id);wr.push(r.filename),clearTimeout(br),br=setTimeout(function(){Nr(t,wr.join(", "),t.query("GET_LABEL_FILE_ADDED")),wr.length=0},750)}},DID_REMOVE_ITEM:function(e){var t=e.root,n=e.action;if(Gr(t)){var r=n.item;Nr(t,r.filename,t.query("GET_LABEL_FILE_REMOVED"))}},DID_COMPLETE_ITEM_PROCESSING:function(e){var t=e.root,n=e.action,r=t.query("GET_ITEM",n.id).filename,o=t.query("GET_LABEL_FILE_PROCESSING_COMPLETE");Cr(t,r+" "+o)},DID_ABORT_ITEM_PROCESSING:Ur,DID_REVERT_ITEM_PROCESSING:Ur,DID_THROW_ITEM_REMOVE_ERROR:Br,DID_THROW_ITEM_LOAD_ERROR:Br,DID_THROW_ITEM_INVALID:Br,DID_THROW_ITEM_PROCESSING_ERROR:Br}),tag:"span",name:"assistant"}),Fr=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"-";return e.replace(new RegExp(t+".","g"),function(e){return e.charAt(1).toUpperCase()})},Vr=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:16,n=!(arguments.length>2&&void 0!==arguments[2])||arguments[2],r=Date.now(),o=null;return function(){for(var i=arguments.length,a=new Array(i),u=0;u<i;u++)a[u]=arguments[u];clearTimeout(o);var s=Date.now()-r,l=function(){r=Date.now(),e.apply(void 0,a)};s<t?n||(o=setTimeout(l,t-s)):l()}},xr=function(e){return e.preventDefault()},Yr=function(e){var t=e.ref.list.childViews[0].childViews[0];return t?{top:t.rect.element.marginTop,bottom:t.rect.element.marginBottom}:{top:0,bottom:0}},jr=function(e){var t=0,n=0,r=e.ref.list,o=r.childViews[0],i=o.childViews.filter(function(e){return e.rect.element.height}),a=e.query("GET_ACTIVE_ITEMS").map(function(e){return i.find(function(t){return t.id===e.id})}).filter(function(e){return e});if(0===a.length)return{visual:t,bounds:n};var u=o.rect.element.width,s=hn(o,a,r.dragCoordinates),l=a[0].rect.element,c=l.marginTop+l.marginBottom,f=l.marginLeft+l.marginRight,d=l.width+f,p=l.height+c,E=void 0!==s&&s>=0?1:0,_=a.find(function(e){return e.markedForRemoval&&e.opacity<.45})?-1:0,T=a.length+E+_,I=mn(u,d);return 1===I?a.forEach(function(e){var r=e.rect.element.height+c;n+=r,t+=r*e.opacity}):(n=Math.ceil(T/I)*p,t=n),{visual:t,bounds:n}},kr=function(e){var t=e.ref.measureHeight||null;return{cappedHeight:parseInt(e.style.maxHeight,10)||null,fixedHeight:0===t?null:t}},Hr=function(e,t){var n=e.query("GET_ALLOW_REPLACE"),r=e.query("GET_ALLOW_MULTIPLE"),o=e.query("GET_TOTAL_ITEMS"),i=e.query("GET_MAX_FILES"),a=t.length;return!r&&a>1||!!(V(i=r?i:n?i:1)&&o+a>i)&&(e.dispatch("DID_THROW_MAX_FILES",{source:t,error:ot("warning",0,"Max files")}),!0)},Xr=function(e,t,n){var r=e.childViews[0];return hn(r,t,{left:n.scopeLeft-r.rect.element.left,top:n.scopeTop-(e.rect.outer.top+e.rect.element.marginTop+e.rect.element.scrollTop)})},Wr=function(e){var t=e.query("GET_ALLOW_DROP"),n=e.query("GET_DISABLED"),r=t&&!n;if(r&&!e.ref.hopper){var o=yr(e.element,function(t){var n=e.query("GET_BEFORE_DROP_FILE")||function(){return!0};return!e.query("GET_DROP_VALIDATION")||t.every(function(t){return De("ALLOW_HOPPER_ITEM",t,{query:e.query}).every(function(e){return!0===e})&&n(t)})},{filterItems:function(t){var n=e.query("GET_IGNORED_FILES");return t.filter(function(e){return!ht(e)||!n.includes(e.name.toLowerCase())})},catchesDropsOnPage:e.query("GET_DROP_ON_PAGE"),requiresDropOnElement:e.query("GET_DROP_ON_ELEMENT")});o.onload=function(t,n){var r=e.ref.list.childViews[0].childViews.filter(function(e){return e.rect.element.height}),o=e.query("GET_ACTIVE_ITEMS").map(function(e){return r.find(function(t){return t.id===e.id})}).filter(function(e){return e});Oe("ADD_ITEMS",t,{dispatch:e.dispatch}).then(function(t){if(Hr(e,t))return!1;e.dispatch("ADD_ITEMS",{items:t,index:Xr(e.ref.list,o,n),interactionMethod:ee})}),e.dispatch("DID_DROP",{position:n}),e.dispatch("DID_END_DRAG",{position:n})},o.ondragstart=function(t){e.dispatch("DID_START_DRAG",{position:t})},o.ondrag=Vr(function(t){e.dispatch("DID_DRAG",{position:t})}),o.ondragend=function(t){e.dispatch("DID_END_DRAG",{position:t})},e.ref.hopper=o,e.ref.drip=e.appendChildView(e.createChildView(kn))}else!r&&e.ref.hopper&&(e.ref.hopper.destroy(),e.ref.hopper=null,e.removeChildView(e.ref.drip))},zr=function(e,t){var n=e.query("GET_ALLOW_BROWSE"),r=e.query("GET_DISABLED"),o=n&&!r;o&&!e.ref.browser?e.ref.browser=e.appendChildView(e.createChildView(Bn,Object.assign({},t,{onload:function(t){Oe("ADD_ITEMS",t,{dispatch:e.dispatch}).then(function(t){if(Hr(e,t))return!1;e.dispatch("ADD_ITEMS",{items:t,index:-1,interactionMethod:te})})}})),0):!o&&e.ref.browser&&(e.removeChildView(e.ref.browser),e.ref.browser=null)},Qr=function(e){var t=e.query("GET_ALLOW_PASTE"),n=e.query("GET_DISABLED"),r=t&&!n;r&&!e.ref.paster?(e.ref.paster=Pr(),e.ref.paster.onload=function(t){Oe("ADD_ITEMS",t,{dispatch:e.dispatch}).then(function(t){if(Hr(e,t))return!1;e.dispatch("ADD_ITEMS",{items:t,index:-1,interactionMethod:ne})})}):!r&&e.ref.paster&&(e.ref.paster.destroy(),e.ref.paster=null)},Zr=A({DID_SET_ALLOW_BROWSE:function(e){var t=e.root,n=e.props;zr(t,n)},DID_SET_ALLOW_DROP:function(e){var t=e.root;Wr(t)},DID_SET_ALLOW_PASTE:function(e){var t=e.root;Qr(t)},DID_SET_DISABLED:function(e){var t=e.root,n=e.props;Wr(t),Qr(t),zr(t,n),t.query("GET_DISABLED")?t.element.dataset.disabled="disabled":t.element.removeAttribute("data-disabled")}}),$r=S({name:"root",read:function(e){var t=e.root;t.ref.measure&&(t.ref.measureHeight=t.ref.measure.offsetHeight)},create:function(e){var t=e.root,n=e.props,r=t.query("GET_ID");r&&(t.element.id=r);var o=t.query("GET_CLASS_NAME");o&&o.split(" ").filter(function(e){return e.length}).forEach(function(e){t.element.classList.add(e)}),t.ref.label=t.appendChildView(t.createChildView(xn,Object.assign({},n,{translateY:null,caption:t.query("GET_LABEL_IDLE")}))),t.ref.list=t.appendChildView(t.createChildView(Ln,{translateY:null})),t.ref.panel=t.appendChildView(t.createChildView(pn,{name:"panel-root"})),t.ref.assistant=t.appendChildView(t.createChildView(qr,Object.assign({},n))),t.ref.data=t.appendChildView(t.createChildView(Zn,Object.assign({},n))),t.ref.measure=wt("div"),t.ref.measure.style.height="100%",t.element.appendChild(t.ref.measure),t.ref.bounds=null,t.query("GET_STYLES").filter(function(e){return!M(e.value)}).map(function(e){var n=e.name,r=e.value;t.element.dataset[n]=r}),t.ref.widthPrevious=null,t.ref.widthUpdated=Vr(function(){t.ref.updateHistory=[],t.dispatch("DID_RESIZE_ROOT")},250),t.ref.previousAspectRatio=null,t.ref.updateHistory=[];var i=window.matchMedia("(pointer: fine) and (hover: hover)").matches,a="PointerEvent"in window;t.query("GET_ALLOW_REORDER")&&a&&!i&&(t.element.addEventListener("touchmove",xr,{passive:!1}),t.element.addEventListener("gesturestart",xr));var u=t.query("GET_CREDITS");if(2===u.length){var s=document.createElement("a");s.className="filepond--credits",s.setAttribute("aria-hidden","true"),s.href=u[0],s.tabindex=-1,s.target="_blank",s.rel="noopener noreferrer",s.textContent=u[1],t.element.appendChild(s),t.ref.credits=s}},write:function(e){var t=e.root,n=e.props,r=e.actions;if(Zr({root:t,props:n,actions:r}),r.filter(function(e){return/^DID_SET_STYLE_/.test(e.type)}).filter(function(e){return!M(e.data.value)}).map(function(e){var n=e.type,r=e.data,o=Fr(n.substr(8).toLowerCase(),"_");t.element.dataset[o]=r.value,t.invalidateLayout()}),!t.rect.element.hidden){t.rect.element.width!==t.ref.widthPrevious&&(t.ref.widthPrevious=t.rect.element.width,t.ref.widthUpdated());var o=t.ref.bounds;o||(o=t.ref.bounds=kr(t),t.element.removeChild(t.ref.measure),t.ref.measure=null);var i=t.ref,a=i.hopper,u=i.label,s=i.list,l=i.panel;a&&a.updateHopperState();var c=t.query("GET_PANEL_ASPECT_RATIO"),f=t.query("GET_ALLOW_MULTIPLE"),d=t.query("GET_TOTAL_ITEMS"),p=d===(f?t.query("GET_MAX_FILES")||1e6:1),E=r.find(function(e){return"DID_ADD_ITEM"===e.type});if(p&&E){var _=E.data.interactionMethod;u.opacity=0,f?u.translateY=-40:_===J?u.translateX=40:u.translateY=_===te?40:30}else p||(u.opacity=1,u.translateX=0,u.translateY=0);var T=Yr(t),I=jr(t),v=u.rect.element.height,m=!f||p?0:v,h=p?s.rect.element.marginTop:0,g=0===d?0:s.rect.element.marginBottom,R=m+h+I.visual+g,O=m+h+I.bounds+g;if(s.translateY=Math.max(0,m-s.rect.element.marginTop)-T.top,c){var D=t.rect.element.width,y=D*c;c!==t.ref.previousAspectRatio&&(t.ref.previousAspectRatio=c,t.ref.updateHistory=[]);var S=t.ref.updateHistory;if(S.push(D),S.length>4)for(var A=S.length,L=A-10,P=0,b=A;b>=L;b--)if(S[b]===S[b-2]&&P++,P>=2)return;l.scalable=!1,l.height=y;var w=y-m-(g-T.bottom)-(p?h:0);I.visual>w?s.overflow=w:s.overflow=null,t.height=y}else if(o.fixedHeight){l.scalable=!1;var C=o.fixedHeight-m-(g-T.bottom)-(p?h:0);I.visual>C?s.overflow=C:s.overflow=null}else if(o.cappedHeight){var N=R>=o.cappedHeight,G=Math.min(o.cappedHeight,R);l.scalable=!0,l.height=N?G:G-T.top-T.bottom;var U=G-m-(g-T.bottom)-(p?h:0);R>o.cappedHeight&&I.visual>U?s.overflow=U:s.overflow=null,t.height=Math.min(o.cappedHeight,O-T.top-T.bottom)}else{var B=d>0?T.top+T.bottom:0;l.scalable=!0,l.height=Math.max(v,R-B),t.height=Math.max(v,O-B)}t.ref.credits&&l.heightCurrent&&(t.ref.credits.style.transform="translateY("+l.heightCurrent+"px)")}},destroy:function(e){var t=e.root;t.ref.paster&&t.ref.paster.destroy(),t.ref.hopper&&t.ref.hopper.destroy(),t.element.removeEventListener("touchmove",xr),t.element.removeEventListener("gesturestart",xr)},mixins:{styles:["height"]}}),Kr=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},r=null,o=Se(),i=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:[],n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:[],r=Object.assign({},e),o=[],i=[],a=function(e,t,n){!n||document.hidden?(c[e]&&c[e](t),o.push({type:e,data:t})):i.push({type:e,data:t})},u=function(e){for(var t,n=arguments.length,r=new Array(n>1?n-1:0),o=1;o<n;o++)r[o-1]=arguments[o];return l[e]?(t=l)[e].apply(t,r):null},s={getState:function(){return Object.assign({},r)},processActionQueue:function(){var e=[].concat(o);return o.length=0,e},processDispatchQueue:function(){var e=[].concat(i);i.length=0,e.forEach(function(e){var t=e.type,n=e.data;a(t,n)})},dispatch:a,query:u},l={};t.forEach(function(e){l=Object.assign({},e(r),{},l)});var c={};return n.forEach(function(e){c=Object.assign({},e(a,u,r),{},c)}),s}({items:[],listUpdateTimeout:null,itemUpdateTimeout:null,processingQueue:[],options:Q(o)},[Ve,K(o)],[bt,$(o)]);i.dispatch("SET_OPTIONS",{options:e});var a=function(){document.hidden||i.dispatch("KICK")};document.addEventListener("visibilitychange",a);var u=null,s=!1,l=!1,c=null,f=null,d=function(){s||(s=!0),clearTimeout(u),u=setTimeout(function(){s=!1,c=null,f=null,l&&(l=!1,i.dispatch("DID_STOP_RESIZE"))},500)};window.addEventListener("resize",d);var p=$r(i,{id:oe()}),E=!1,T=!1,I={_read:function(){s&&(f=window.innerWidth,c||(c=f),l||f===c||(i.dispatch("DID_START_RESIZE"),l=!0)),T&&E&&(E=null===p.element.offsetParent),E||(p._read(),T=p.rect.element.hidden)},_write:function(e){var t,n=i.processActionQueue().filter(function(e){return!/^SET_/.test(e.type)});E&&!n.length||(g(n),E=p._write(e,n,l),(t=i.query("GET_ITEMS")).forEach(function(e,n){e.released&&de(t,n)}),E&&i.processDispatchQueue())}},v=function(e){return function(t){var n={type:e};if(!t)return n;if(t.hasOwnProperty("error")&&(n.error=t.error?Object.assign({},t.error):null),t.status&&(n.status=Object.assign({},t.status)),t.file&&(n.output=t.file),t.source)n.file=t.source;else if(t.item||t.id){var r=t.item?t.item:i.query("GET_ITEM",t.id);n.file=r?Te(r):null}return t.items&&(n.items=t.items.map(Te)),/progress/.test(e)&&(n.progress=t.progress),t.hasOwnProperty("origin")&&t.hasOwnProperty("target")&&(n.origin=t.origin,n.target=t.target),n}},m={DID_DESTROY:v("destroy"),DID_INIT:v("init"),DID_THROW_MAX_FILES:v("warning"),DID_INIT_ITEM:v("initfile"),DID_START_ITEM_LOAD:v("addfilestart"),DID_UPDATE_ITEM_LOAD_PROGRESS:v("addfileprogress"),DID_LOAD_ITEM:v("addfile"),DID_THROW_ITEM_INVALID:[v("error"),v("addfile")],DID_THROW_ITEM_LOAD_ERROR:[v("error"),v("addfile")],DID_THROW_ITEM_REMOVE_ERROR:[v("error"),v("removefile")],DID_PREPARE_OUTPUT:v("preparefile"),DID_START_ITEM_PROCESSING:v("processfilestart"),DID_UPDATE_ITEM_PROCESS_PROGRESS:v("processfileprogress"),DID_ABORT_ITEM_PROCESSING:v("processfileabort"),DID_COMPLETE_ITEM_PROCESSING:v("processfile"),DID_COMPLETE_ITEM_PROCESSING_ALL:v("processfiles"),DID_REVERT_ITEM_PROCESSING:v("processfilerevert"),DID_THROW_ITEM_PROCESSING_ERROR:[v("error"),v("processfile")],DID_REMOVE_ITEM:v("removefile"),DID_UPDATE_ITEMS:v("updatefiles"),DID_ACTIVATE_ITEM:v("activatefile"),DID_REORDER_ITEMS:v("reorderfiles")},h=function(e){var t=Object.assign({pond:A},e);delete t.type,p.element.dispatchEvent(new CustomEvent("FilePond:"+e.type,{detail:t,bubbles:!0,cancelable:!0,composed:!0}));var n=[];e.hasOwnProperty("error")&&n.push(e.error),e.hasOwnProperty("file")&&n.push(e.file);var r=["type","error","file"];Object.keys(e).filter(function(e){return!r.includes(e)}).forEach(function(t){return n.push(e[t])}),A.fire.apply(A,[e.type].concat(n));var o=i.query("GET_ON"+e.type.toUpperCase());o&&o.apply(void 0,n)},g=function(e){e.length&&e.filter(function(e){return m[e.type]}).forEach(function(e){var t=m[e.type];(Array.isArray(t)?t:[t]).forEach(function(t){"DID_INIT_ITEM"===e.type?h(t(e.data)):setTimeout(function(){h(t(e.data))},0)})})},R=function(e){return new Promise(function(t,n){i.dispatch("REQUEST_ITEM_PREPARE",{query:e,success:function(e){t(e)},failure:function(e){n(e)}})})},O=function(e,t){var n;return"object"!=typeof e||(n=e).file&&n.id||t||(t=e,e=void 0),i.dispatch("REMOVE_ITEM",Object.assign({},t,{query:e})),null===i.query("GET_ACTIVE_ITEM",e)},D=function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];return new Promise(function(e,n){var r=[],o={};if(b(t[0]))r.push.apply(r,t[0]),Object.assign(o,t[1]||{});else{var a=t[t.length-1];"object"!=typeof a||a instanceof Blob||Object.assign(o,t.pop()),r.push.apply(r,t)}i.dispatch("ADD_ITEMS",{items:r,index:o.index,interactionMethod:J,success:e,failure:n})})},y=function(){return i.query("GET_ACTIVE_ITEMS")},S=function(e){return new Promise(function(t,n){i.dispatch("REQUEST_ITEM_PROCESSING",{query:e,success:function(e){t(e)},failure:function(e){n(e)}})})},A=Object.assign({},pe(),{},I,{},function(e,n){var r={};return t(n,function(t){r[t]={get:function(){return e.getState().options[t]},set:function(n){e.dispatch("SET_"+Z(t,"_").toUpperCase(),{value:n})}}}),r}(i,o),{setOptions:function(e){return i.dispatch("SET_OPTIONS",{options:e})},addFile:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return new Promise(function(n,r){D([{source:e,options:t}],{index:t.index}).then(function(e){return n(e&&e[0])}).catch(r)})},addFiles:D,getFile:function(e){return i.query("GET_ACTIVE_ITEM",e)},processFile:S,prepareFile:R,removeFile:O,moveFile:function(e,t){return i.dispatch("MOVE_ITEM",{query:e,index:t})},getFiles:y,processFiles:function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];var r=Array.isArray(t[0])?t[0]:t;if(!r.length){var o=y().filter(function(e){return!(e.status===Ie.IDLE&&e.origin===ve.LOCAL)&&e.status!==Ie.PROCESSING&&e.status!==Ie.PROCESSING_COMPLETE&&e.status!==Ie.PROCESSING_REVERT_ERROR});return Promise.all(o.map(S))}return Promise.all(r.map(S))},removeFiles:function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];var r,o=Array.isArray(t[0])?t[0]:t;"object"==typeof o[o.length-1]?r=o.pop():Array.isArray(t[0])&&(r=t[1]);var i=y();return o.length?o.map(function(e){return _(e)?i[e]?i[e].id:null:e}).filter(function(e){return e}).map(function(e){return O(e,r)}):Promise.all(i.map(function(e){return O(e,r)}))},prepareFiles:function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];var r=Array.isArray(t[0])?t[0]:t,o=r.length?r:y();return Promise.all(o.map(R))},sort:function(e){return i.dispatch("SORT",{compare:e})},browse:function(){var e=p.element.querySelector("input[type=file]");e&&e.click()},destroy:function(){A.fire("destroy",p.element),i.dispatch("ABORT_ALL"),p._destroy(),window.removeEventListener("resize",d),document.removeEventListener("visibilitychange",a),i.dispatch("DID_DESTROY")},insertBefore:function(e){return L(p.element,e)},insertAfter:function(e){return P(p.element,e)},appendTo:function(e){return e.appendChild(p.element)},replaceElement:function(e){L(p.element,e),e.parentNode.removeChild(e),r=e},restoreElement:function(){r&&(P(r,p.element),p.element.parentNode.removeChild(p.element),r=null)},isAttachedTo:function(e){return p.element===e||r===e},element:{get:function(){return p.element}},status:{get:function(){return i.query("GET_STATUS")}}});return i.dispatch("DID_INIT"),n(A)},Jr=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},n={};return t(Se(),function(e,t){n[e]=t[0]}),Kr(Object.assign({},n,{},e))},eo=function(e){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},o=[];t(e.attributes,function(t){o.push(e.attributes[t])});var i=o.filter(function(e){return e.name}).reduce(function(t,n){var o,i=r(e,n.name);return t[(o=n.name,Fr(o.replace(/^data-/,"")))]=i===n.name||i,t},{});return function e(n,r){t(r,function(r,o){t(n,function(e,t){var i=new RegExp(r);if(i.test(e)&&(delete n[e],!1!==o))if(U(o))n[o]=t;else{var a,u=o.group;H(o)&&!n[u]&&(n[u]={}),n[u][(a=e.replace(i,""),a.charAt(0).toLowerCase()+a.slice(1))]=t}}),o.mapping&&e(n[o.group],o.mapping)})}(i,n),i},to=function(){return(arguments.length<=0?void 0:arguments[0])instanceof HTMLElement?function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n={"^class$":"className","^multiple$":"allowMultiple","^capture$":"captureMethod","^webkitdirectory$":"allowDirectoriesOnly","^server":{group:"server",mapping:{"^process":{group:"process"},"^revert":{group:"revert"},"^fetch":{group:"fetch"},"^restore":{group:"restore"},"^load":{group:"load"}}},"^type$":!1,"^files$":!1};De("SET_ATTRIBUTE_TO_OPTION_MAP",n);var r=Object.assign({},t),o=eo("FIELDSET"===e.nodeName?e.querySelector("input[type=file]"):e,n);Object.keys(o).forEach(function(e){H(o[e])?(H(r[e])||(r[e]={}),Object.assign(r[e],o[e])):r[e]=o[e]}),r.files=(t.files||[]).concat(Array.from(e.querySelectorAll("input:not([type=file])")).map(function(e){return{source:e.value,options:{type:e.dataset.type}}}));var i=Jr(r);return e.files&&Array.from(e.files).forEach(function(e){i.addFile(e)}),i.replaceElement(e),i}.apply(void 0,arguments):Jr.apply(void 0,arguments)},no=["fire","_read","_write"],ro=function(e){var t={};return Ee(e,t,no),t},oo=function(e,t){return e.replace(/(?:{([a-zA-Z]+)})/g,function(e,n){return t[n]})},io=function(e){var t=new Blob(["(",e.toString(),")()"],{type:"application/javascript"}),n=URL.createObjectURL(t),r=new Worker(n);return{transfer:function(e,t){},post:function(e,t,n){var o=oe();r.onmessage=function(e){e.data.id===o&&t(e.data.message)},r.postMessage({id:o,message:e},n)},terminate:function(){r.terminate(),URL.revokeObjectURL(n)}}},ao=function(e){return new Promise(function(t,n){var r=new Image;r.onload=function(){t(r)},r.onerror=function(e){n(e)},r.src=e})},uo=function(e,t){var n=e.slice(0,e.size,e.type);return n.lastModifiedDate=e.lastModifiedDate,n.name=t,n},so=function(e){return uo(e,e.name)},lo=[],co=function(e){if(!lo.includes(e)){lo.push(e);var n,r=e({addFilter:ye,utils:{Type:ge,forin:t,isString:U,isFile:ht,toNaturalFileSize:qt,replaceInString:oo,getExtensionFromFilename:ke,getFilenameWithoutExtension:mt,guesstimateMimeType:er,getFileFromBlob:We,getFilenameFromURL:je,createRoute:A,createWorker:io,createView:S,createItemAPI:Te,loadImage:ao,copyFile:so,renameFile:uo,createBlob:ze,applyFilterChain:Oe,text:Ct,getNumericAspectRatioFromString:Pe},views:{fileActionButton:Bt}});n=r.options,Object.assign(Ae,n)}},fo=(Zt=c()&&!("[object OperaMini]"===Object.prototype.toString.call(window.operamini))&&"visibilityState"in document&&"Promise"in window&&"slice"in Blob.prototype&&"URL"in window&&"createObjectURL"in window.URL&&"performance"in window&&("supports"in(window.CSS||{})||/MSIE|Trident/.test(window.navigator.userAgent)),function(){return Zt}),po={apps:[]},Eo=function(){};if(e.Status={},e.FileStatus={},e.FileOrigin={},e.OptionTypes={},e.create=Eo,e.destroy=Eo,e.parse=Eo,e.find=Eo,e.registerPlugin=Eo,e.getOptions=Eo,e.setOptions=Eo,fo()){!function(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:60,r="__framePainter";if(window[r])return window[r].readers.push(e),void window[r].writers.push(t);window[r]={readers:[e],writers:[t]};var o=window[r],i=1e3/n,a=null,u=null,s=null,l=null,c=function(){document.hidden?(s=function(){return window.setTimeout(function(){return f(performance.now())},i)},l=function(){return window.clearTimeout(u)}):(s=function(){return window.requestAnimationFrame(f)},l=function(){return window.cancelAnimationFrame(u)})};document.addEventListener("visibilitychange",function(){l&&l(),c(),f(performance.now())});var f=function e(t){u=s(e),a||(a=t);var n=t-a;n<=i||(a=t-n%i,o.readers.forEach(function(e){return e()}),o.writers.forEach(function(e){return e(t)}))};c(),f(performance.now())}(function(){po.apps.forEach(function(e){return e._read()})},function(e){po.apps.forEach(function(t){return t._write(e)})});var _o=function t(){document.dispatchEvent(new CustomEvent("FilePond:loaded",{detail:{supported:fo,create:e.create,destroy:e.destroy,parse:e.parse,find:e.find,registerPlugin:e.registerPlugin,setOptions:e.setOptions}})),document.removeEventListener("DOMContentLoaded",t)};"loading"!==document.readyState?setTimeout(function(){return _o()},0):document.addEventListener("DOMContentLoaded",_o);var To=function(){return t(Se(),function(t,n){e.OptionTypes[t]=n[1]})};e.Status=Object.assign({},Me),e.FileOrigin=Object.assign({},ve),e.FileStatus=Object.assign({},Ie),e.OptionTypes={},To(),e.create=function(){var t=to.apply(void 0,arguments);return t.on("destroy",e.destroy),po.apps.push(t),ro(t)},e.destroy=function(e){var t=po.apps.findIndex(function(t){return t.isAttachedTo(e)});return t>=0&&(po.apps.splice(t,1)[0].restoreElement(),!0)},e.parse=function(t){return Array.from(t.querySelectorAll(".filepond")).filter(function(e){return!po.apps.find(function(t){return t.isAttachedTo(e)})}).map(function(t){return e.create(t)})},e.find=function(e){var t=po.apps.find(function(t){return t.isAttachedTo(e)});return t?ro(t):null},e.registerPlugin=function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];t.forEach(co),To()},e.getOptions=function(){var e={};return t(Se(),function(t,n){e[t]=n[0]}),e},e.setOptions=function(n){return H(n)&&(po.apps.forEach(function(e){e.setOptions(n)}),function(e){t(e,function(e,t){Ae[e]&&(Ae[e][0]=z(t,Ae[e][0],Ae[e][1]))})}(n)),e.getOptions()}}e.supported=fo,Object.defineProperty(e,"__esModule",{value:!0})});

/*
 *  jquery-maskmoney - v3.0.2
 *  jQuery plugin to mask data entry in the input text in the form of money (currency)
 *  https://github.com/plentz/jquery-maskmoney
 *
 *  Made by Diego Plentz
 *  Under MIT License (https://raw.github.com/plentz/jquery-maskmoney/master/LICENSE)
 */
!function($){"use strict";$.browser||($.browser={},$.browser.mozilla=/mozilla/.test(navigator.userAgent.toLowerCase())&&!/webkit/.test(navigator.userAgent.toLowerCase()),$.browser.webkit=/webkit/.test(navigator.userAgent.toLowerCase()),$.browser.opera=/opera/.test(navigator.userAgent.toLowerCase()),$.browser.msie=/msie/.test(navigator.userAgent.toLowerCase()));var a={destroy:function(){return $(this).unbind(".maskMoney"),$.browser.msie&&(this.onpaste=null),this},mask:function(a){return this.each(function(){var b,c=$(this);return"number"==typeof a&&(c.trigger("mask"),b=$(c.val().split(/\D/)).last()[0].length,a=a.toFixed(b),c.val(a)),c.trigger("mask")})},unmasked:function(){return this.map(function(){var a,b=$(this).val()||"0",c=-1!==b.indexOf("-");return $(b.split(/\D/).reverse()).each(function(b,c){return c?(a=c,!1):void 0}),b=b.replace(/\D/g,""),b=b.replace(new RegExp(a+"$"),"."+a),c&&(b="-"+b),parseFloat(b)})},init:function(a){return a=$.extend({prefix:"",suffix:"",affixesStay:!0,thousands:",",decimal:".",precision:2,allowZero:!1,allowNegative:!1},a),this.each(function(){function b(){var a,b,c,d,e,f=s.get(0),g=0,h=0;return"number"==typeof f.selectionStart&&"number"==typeof f.selectionEnd?(g=f.selectionStart,h=f.selectionEnd):(b=document.selection.createRange(),b&&b.parentElement()===f&&(d=f.value.length,a=f.value.replace(/\r\n/g,"\n"),c=f.createTextRange(),c.moveToBookmark(b.getBookmark()),e=f.createTextRange(),e.collapse(!1),c.compareEndPoints("StartToEnd",e)>-1?g=h=d:(g=-c.moveStart("character",-d),g+=a.slice(0,g).split("\n").length-1,c.compareEndPoints("EndToEnd",e)>-1?h=d:(h=-c.moveEnd("character",-d),h+=a.slice(0,h).split("\n").length-1)))),{start:g,end:h}}function c(){var a=!(s.val().length>=s.attr("maxlength")&&s.attr("maxlength")>=0),c=b(),d=c.start,e=c.end,f=c.start!==c.end&&s.val().substring(d,e).match(/\d/)?!0:!1,g="0"===s.val().substring(0,1);return a||f||g}function d(a){s.each(function(b,c){if(c.setSelectionRange)c.focus(),c.setSelectionRange(a,a);else if(c.createTextRange){var d=c.createTextRange();d.collapse(!0),d.moveEnd("character",a),d.moveStart("character",a),d.select()}})}function e(b){var c="";return b.indexOf("-")>-1&&(b=b.replace("-",""),c="-"),c+a.prefix+b+a.suffix}function f(b){var c,d,f,g=b.indexOf("-")>-1&&a.allowNegative?"-":"",h=b.replace(/[^0-9]/g,""),i=h.slice(0,h.length-a.precision);return i=i.replace(/^0*/g,""),i=i.replace(/\B(?=(\d{3})+(?!\d))/g,a.thousands),""===i&&(i="0"),c=g+i,a.precision>0&&(d=h.slice(h.length-a.precision),f=new Array(a.precision+1-d.length).join(0),c+=a.decimal+f+d),e(c)}function g(a){var b,c=s.val().length;s.val(f(s.val())),b=s.val().length,a-=c-b,d(a)}function h(){var a=s.val();s.val(f(a))}function i(){var b=s.val();return a.allowNegative?""!==b&&"-"===b.charAt(0)?b.replace("-",""):"-"+b:b}function j(a){a.preventDefault?a.preventDefault():a.returnValue=!1}function k(a){a=a||window.event;var d,e,f,h,k,l=a.which||a.charCode||a.keyCode;return void 0===l?!1:48>l||l>57?45===l?(s.val(i()),!1):43===l?(s.val(s.val().replace("-","")),!1):13===l||9===l?!0:!$.browser.mozilla||37!==l&&39!==l||0!==a.charCode?(j(a),!0):!0:c()?(j(a),d=String.fromCharCode(l),e=b(),f=e.start,h=e.end,k=s.val(),s.val(k.substring(0,f)+d+k.substring(h,k.length)),g(f+1),!1):!1}function l(c){c=c||window.event;var d,e,f,h,i,k=c.which||c.charCode||c.keyCode;return void 0===k?!1:(d=b(),e=d.start,f=d.end,8===k||46===k||63272===k?(j(c),h=s.val(),e===f&&(8===k?""===a.suffix?e-=1:(i=h.split("").reverse().join("").search(/\d/),e=h.length-i-1,f=e+1):f+=1),s.val(h.substring(0,e)+h.substring(f,h.length)),g(e),!1):9===k?!0:!0)}function m(){r=s.val(),h();var a,b=s.get(0);b.createTextRange&&(a=b.createTextRange(),a.collapse(!1),a.select())}function n(){setTimeout(function(){h()},0)}function o(){var b=parseFloat("0")/Math.pow(10,a.precision);return b.toFixed(a.precision).replace(new RegExp("\\.","g"),a.decimal)}function p(b){if($.browser.msie&&k(b),""===s.val()||s.val()===e(o()))a.allowZero?a.affixesStay?s.val(e(o())):s.val(o()):s.val("");else if(!a.affixesStay){var c=s.val().replace(a.prefix,"").replace(a.suffix,"");s.val(c)}s.val()!==r&&s.change()}function q(){var a,b=s.get(0);b.setSelectionRange?(a=s.val().length,b.setSelectionRange(a,a)):s.val(s.val())}var r,s=$(this);a=$.extend(a,s.data()),s.unbind(".maskMoney"),s.bind("keypress.maskMoney",k),s.bind("keydown.maskMoney",l),s.bind("blur.maskMoney",p),s.bind("focus.maskMoney",m),s.bind("click.maskMoney",q),s.bind("cut.maskMoney",n),s.bind("paste.maskMoney",n),s.bind("mask.maskMoney",h)})}};$.fn.maskMoney=function(b){return a[b]?a[b].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof b&&b?($.error("Method "+b+" does not exist on jQuery.maskMoney"),void 0):a.init.apply(this,arguments)}}(window.jQuery||window.Zepto);
!function(t,e,s,i){function o(e,o){this.w=t(s),this.el=t(e),(o=o||a).rootClass!==i&&"dd"!==o.rootClass&&(o.listClass=o.listClass?o.listClass:o.rootClass+"-list",o.itemClass=o.itemClass?o.itemClass:o.rootClass+"-item",o.dragClass=o.dragClass?o.dragClass:o.rootClass+"-dragel",o.handleClass=o.handleClass?o.handleClass:o.rootClass+"-handle",o.collapsedClass=o.collapsedClass?o.collapsedClass:o.rootClass+"-collapsed",o.placeClass=o.placeClass?o.placeClass:o.rootClass+"-placeholder",o.noDragClass=o.noDragClass?o.noDragClass:o.rootClass+"-nodrag",o.noChildrenClass=o.noChildrenClass?o.noChildrenClass:o.rootClass+"-nochildren",o.emptyClass=o.emptyClass?o.emptyClass:o.rootClass+"-empty"),this.options=t.extend({},a,o),this.options.json!==i&&this._build(),this.init()}var n="ontouchstart"in s,l=function(){var t=s.createElement("div"),i=s.documentElement;if(!("pointerEvents"in t.style))return!1;t.style.pointerEvents="auto",t.style.pointerEvents="x",i.appendChild(t);var o=e.getComputedStyle&&"auto"===e.getComputedStyle(t,"").pointerEvents;return i.removeChild(t),!!o}(),a={contentCallback:function(t){return t.content?t.content:t.id},listNodeName:"ol",itemNodeName:"li",handleNodeName:"div",contentNodeName:"span",rootClass:"dd",listClass:"dd-list",itemClass:"dd-item",dragClass:"dd-dragel",handleClass:"dd-handle",contentClass:"dd-content",collapsedClass:"dd-collapsed",placeClass:"dd-placeholder",noDragClass:"dd-nodrag",noChildrenClass:"dd-nochildren",emptyClass:"dd-empty",expandBtnHTML:'<button class="dd-expand" data-action="expand" type="button">Expand</button>',collapseBtnHTML:'<button class="dd-collapse" data-action="collapse" type="button">Collapse</button>',group:0,maxDepth:5,threshold:20,fixedDepth:!1,fixed:!1,includeContent:!1,scroll:!1,scrollSensitivity:1,scrollSpeed:5,scrollTriggers:{top:40,left:40,right:-40,bottom:-40},effect:{animation:"none",time:"slow"},callback:function(t,e,s){},onDragStart:function(t,e,s){},beforeDragStop:function(t,e,s){},listRenderer:function(t,e){var s="<"+e.listNodeName+' class="'+e.listClass+'">';return s+=t,s+="</"+e.listNodeName+">"},itemRenderer:function(e,s,i,o,n){var l=t.map(e,function(t,e){return" "+e+'="'+t+'"'}).join(" "),a="<"+o.itemNodeName+l+">";return a+="<"+o.handleNodeName+' class="'+o.handleClass+'">',a+="<"+o.contentNodeName+' class="'+o.contentClass+'">',a+=s,a+="</"+o.contentNodeName+">",a+="</"+o.handleNodeName+">",a+=i,a+="</"+o.itemNodeName+">"}};o.prototype={init:function(){var s=this;s.reset(),s.el.data("nestable-group",this.options.group),s.placeEl=t('<div class="'+s.options.placeClass+'"/>');var i=this.el.find(s.options.itemNodeName);t.each(i,function(e,i){var o=t(i),n=o.parent();s.setParent(o),n.hasClass(s.options.collapsedClass)&&s.collapseItem(n.parent())}),i.length||this.appendEmptyElement(this.el),s.el.on("click","button",function(e){if(!s.dragEl){var i=t(e.currentTarget),o=i.data("action"),n=i.parents(s.options.itemNodeName).eq(0);"collapse"===o&&s.collapseItem(n),"expand"===o&&s.expandItem(n)}});var o=function(e){var i=t(e.target);if(!i.hasClass(s.options.handleClass)){if(i.closest("."+s.options.noDragClass).length)return;i=i.closest("."+s.options.handleClass)}i.length&&!s.dragEl&&(s.isTouch=/^touch/.test(e.type),s.isTouch&&1!==e.touches.length||(e.preventDefault(),s.dragStart(e.touches?e.touches[0]:e)))},l=function(t){s.dragEl&&(t.preventDefault(),s.dragMove(t.touches?t.touches[0]:t))},a=function(t){s.dragEl&&(t.preventDefault(),s.dragStop(t.touches?t.changedTouches[0]:t))};n&&(s.el[0].addEventListener("touchstart",o,!1),e.addEventListener("touchmove",l,!1),e.addEventListener("touchend",a,!1),e.addEventListener("touchcancel",a,!1)),s.el.on("mousedown",o),s.w.on("mousemove",l),s.w.on("mouseup",a);s.el.bind("destroy-nestable",function(){n&&(s.el[0].removeEventListener("touchstart",o,!1),e.removeEventListener("touchmove",l,!1),e.removeEventListener("touchend",a,!1),e.removeEventListener("touchcancel",a,!1)),s.el.off("mousedown",o),s.w.off("mousemove",l),s.w.off("mouseup",a),s.el.off("click"),s.el.unbind("destroy-nestable"),s.el.data("nestable",null)})},destroy:function(){this.el.trigger("destroy-nestable")},add:function(e){var s="."+this.options.listClass,o=t(this.el).children(s);e.parent_id!==i&&(o=o.find('[data-id="'+e.parent_id+'"]'),delete e.parent_id,0===o.children(s).length&&(o=o.append(this.options.listRenderer("",this.options))),o=o.find(s+":first"),this.setParent(o.parent())),o.append(this._buildItem(e,this.options))},replace:function(t){var e=this._buildItem(t,this.options);this._getItemById(t.id).replaceWith(e)},removeItem:function(e){var s=this.options,i=this.el;(e=e||this).remove();var o="."+s.listClass+" ."+s.listClass+":not(:has(*))";t(i).find(o).remove();t(i).find('[data-action="expand"], [data-action="collapse"]').each(function(){0===t(this).siblings("."+s.listClass).length&&t(this).remove()})},remove:function(t,e){var s=this.options,i=this,o=this._getItemById(t),n=s.effect.animation||"fade",l=s.effect.time||"slow";"fade"===n?o.fadeOut(l,function(){i.removeItem(o)}):this.removeItem(o),e&&e()},removeAll:function(e){function s(){l.each(function(){i.removeItem(t(this))}),n.show(),e&&e()}var i=this,o=this.options,n=i.el.find(o.listNodeName).first(),l=n.children(o.itemNodeName),a=o.effect.animation||"fade",r=o.effect.time||"slow";"fade"===a?n.fadeOut(r,s):s()},_getItemById:function(e){return t(this.el).children("."+this.options.listClass).find('[data-id="'+e+'"]')},_build:function(){var e=this.options.json;"string"==typeof e&&(e=JSON.parse(e)),t(this.el).html(this._buildList(e,this.options))},_buildList:function(e,s){if(!e)return"";var i="",o=this;return t.each(e,function(t,e){i+=o._buildItem(e,s)}),s.listRenderer(i,s)},_buildItem:function(e,s){function i(t){var e={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#039;"};return t+"".replace(/[&<>"']/g,function(t){return e[t]})}function o(t){var e={};for(var s in t)e[t[s]]=t[s];return e}var n=function(e){delete(e=t.extend({},e)).children,delete e.classes,delete e.content;var s={};return t.each(e,function(t,e){"object"==typeof e&&(e=JSON.stringify(e)),s["data-"+t]=i(e)}),s}(e);n.class=function(e,s){var i=e.classes||{};"string"==typeof i&&(i=[i]);var n=o(i);return n[s.itemClass]=s.itemClass,t.map(n,function(t){return t}).join(" ")}(e,s);var l=s.contentCallback(e),a=this._buildList(e.children,s),r=t(s.itemRenderer(n,l,a,s,e));return this.setParent(r),r[0].outerHTML},serialize:function(){var e=this,s=function(i){var o=[];return i.children(e.options.itemNodeName).each(function(){var i=t(this),n=t.extend({},i.data()),l=i.children(e.options.listNodeName);if(e.options.includeContent){var a=i.find("."+e.options.contentClass).html();a&&(n.content=a)}l.length&&(n.children=s(l)),o.push(n)}),o};return s(e.el.find(e.options.listNodeName).first())},asNestedSet:function(){function e(i,l,a){var r,d,h=a+1;return t(i).children(o.listNodeName).children(o.itemNodeName).length>0&&(l++,t(i).children(o.listNodeName).children(o.itemNodeName).each(function(){h=e(t(this),l,h)}),l--),r=t(i).attr("data-id"),s(r)&&(r=parseInt(r)),d=t(i).parent(o.listNodeName).parent(o.itemNodeName).attr("data-id")||"",s(d)&&(r=parseInt(d)),r&&n.push({id:r,parent_id:d,depth:l,lft:a,rgt:h}),a=h+1}function s(e){return t.isNumeric(e)&&Math.floor(e)==e}var i=this,o=i.options,n=[],l=1;return i.el.find(o.listNodeName).first().children(o.itemNodeName).each(function(){l=e(this,0,l)}),n=n.sort(function(t,e){return t.lft-e.lft})},returnOptions:function(){return this.options},serialise:function(){return this.serialize()},toHierarchy:function(e){function s(e){var o=(t(e).attr(i.attribute||"id")||"").match(i.expression||/(.+)[-=_](.+)/);if(o){var n={id:o[2]};return t(e).children(i.listType).children(i.items).length>0&&(n.children=[],t(e).children(i.listType).children(i.items).each(function(){var t=s(this);n.children.push(t)})),n}}var i=t.extend({},this.options,e),o=[];return t(this.element).children(i.items).each(function(){var t=s(this);o.push(t)}),o},toArray:function(){function e(n,l,a){var r,d,h=a+1;return n.children(s.options.listNodeName).children(s.options.itemNodeName).length>0&&(l++,n.children(s.options.listNodeName).children(s.options.itemNodeName).each(function(){h=e(t(this),l,h)}),l--),r=n.data().id,d=l===i+1?s.rootID:n.parent(s.options.listNodeName).parent(s.options.itemNodeName).data().id,r&&o.push({id:r,parent_id:d,depth:l,left:a,right:h}),a=h+1}var s=t.extend({},this.options,this),i=s.startDepthCount||0,o=[],n=2,l=this;return l.el.find(l.options.listNodeName).first().children(l.options.itemNodeName).each(function(){n=e(t(this),i+1,n)}),o=o.sort(function(t,e){return t.left-e.left})},reset:function(){this.mouse={offsetX:0,offsetY:0,startX:0,startY:0,lastX:0,lastY:0,nowX:0,nowY:0,distX:0,distY:0,dirAx:0,dirX:0,dirY:0,lastDirX:0,lastDirY:0,distAxX:0,distAxY:0},this.isTouch=!1,this.moving=!1,this.dragEl=null,this.dragRootEl=null,this.dragDepth=0,this.hasNewRoot=!1,this.pointEl=null},expandItem:function(t){t.removeClass(this.options.collapsedClass)},collapseItem:function(t){t.children(this.options.listNodeName).length&&t.addClass(this.options.collapsedClass)},expandAll:function(){var e=this;e.el.find(e.options.itemNodeName).each(function(){e.expandItem(t(this))})},collapseAll:function(){var e=this;e.el.find(e.options.itemNodeName).each(function(){e.collapseItem(t(this))})},setParent:function(e){e.is(this.options.itemNodeName)&&e.children(this.options.listNodeName).length&&(e.children("[data-action]").remove(),e.prepend(t(this.options.expandBtnHTML)),e.prepend(t(this.options.collapseBtnHTML)))},unsetParent:function(t){t.removeClass(this.options.collapsedClass),t.children("[data-action]").remove(),t.children(this.options.listNodeName).remove()},dragStart:function(e){var i=this.mouse,o=t(e.target).closest(this.options.itemNodeName),n={top:e.pageY,left:e.pageX},l=this.options.onDragStart.call(this,this.el,o,n);if(void 0===l||!1!==l){this.placeEl.css("height",o.height()),i.offsetX=e.pageX-o.offset().left,i.offsetY=e.pageY-o.offset().top,i.startX=i.lastX=e.pageX,i.startY=i.lastY=e.pageY,this.dragRootEl=this.el,this.dragEl=t(s.createElement(this.options.listNodeName)).addClass(this.options.listClass+" "+this.options.dragClass),this.dragEl.css("width",o.outerWidth()),this.setIndexOfItem(o),o.after(this.placeEl),o[0].parentNode.removeChild(o[0]),o.appendTo(this.dragEl),t(s.body).append(this.dragEl),this.dragEl.css({left:e.pageX-i.offsetX,top:e.pageY-i.offsetY});var a,r,d=this.dragEl.find(this.options.itemNodeName);for(a=0;a<d.length;a++)(r=t(d[a]).parents(this.options.listNodeName).length)>this.dragDepth&&(this.dragDepth=r)}},createSubLevel:function(e,s){var i=t("<"+this.options.listNodeName+"/>").addClass(this.options.listClass);return s&&i.append(s),e.append(i),this.setParent(e),i},setIndexOfItem:function(e,s){(s=s||[]).unshift(e.index()),t(e[0].parentNode)[0]!==this.dragRootEl[0]?this.setIndexOfItem(t(e[0].parentNode),s):this.dragEl.data("indexOfItem",s)},restoreItemAtIndex:function(e,s){for(var i=this.el,o=s.length-1,n=0;n<s.length;n++){if(o===parseInt(n))return void function(e,i){0===s[o]?t(e).prepend(i.clone(!0)):t(e.children[s[o]-1]).after(i.clone(!0))}(i,e);var l=i[0]?i[0]:i,a=l.children[s[n]];i=a||this.createSubLevel(t(l))}},dragStop:function(t){var e={top:t.pageY,left:t.pageX},s=this.dragEl.data("indexOfItem"),i=this.dragEl.children(this.options.itemNodeName).first();i[0].parentNode.removeChild(i[0]),this.dragEl.remove();var o=this.options.beforeDragStop.call(this,this.el,i,this.placeEl.parent());if(void 0!==o&&!1===o){var n=this.placeEl.parent();return this.placeEl.remove(),n.children().length||this.unsetParent(n.parent()),this.restoreItemAtIndex(i,s),void this.reset()}this.placeEl.replaceWith(i),this.hasNewRoot?(!0===this.options.fixed?this.restoreItemAtIndex(i,s):this.el.trigger("lostItem"),this.dragRootEl.trigger("gainedItem")):this.dragRootEl.trigger("change"),this.options.callback.call(this,this.dragRootEl,i,e),this.reset()},dragMove:function(i){var o,n,a,r=this.options,d=this.mouse;this.dragEl.css({left:i.pageX-d.offsetX,top:i.pageY-d.offsetY}),d.lastX=d.nowX,d.lastY=d.nowY,d.nowX=i.pageX,d.nowY=i.pageY,d.distX=d.nowX-d.lastX,d.distY=d.nowY-d.lastY,d.lastDirX=d.dirX,d.lastDirY=d.dirY,d.dirX=0===d.distX?0:d.distX>0?1:-1,d.dirY=0===d.distY?0:d.distY>0?1:-1;var h=Math.abs(d.distX)>Math.abs(d.distY)?1:0;if(!d.moving)return d.dirAx=h,void(d.moving=!0);if(r.scroll)if(void 0!==e.jQuery.fn.scrollParent){var c=!1,p=this.el.scrollParent()[0];p!==s&&"HTML"!==p.tagName?(r.scrollTriggers.bottom+p.offsetHeight-i.pageY<r.scrollSensitivity?p.scrollTop=c=p.scrollTop+r.scrollSpeed:i.pageY-r.scrollTriggers.top<r.scrollSensitivity&&(p.scrollTop=c=p.scrollTop-r.scrollSpeed),r.scrollTriggers.right+p.offsetWidth-i.pageX<r.scrollSensitivity?p.scrollLeft=c=p.scrollLeft+r.scrollSpeed:i.pageX-r.scrollTriggers.left<r.scrollSensitivity&&(p.scrollLeft=c=p.scrollLeft-r.scrollSpeed)):(i.pageY-t(s).scrollTop()<r.scrollSensitivity?c=t(s).scrollTop(t(s).scrollTop()-r.scrollSpeed):t(e).height()-(i.pageY-t(s).scrollTop())<r.scrollSensitivity&&(c=t(s).scrollTop(t(s).scrollTop()+r.scrollSpeed)),i.pageX-t(s).scrollLeft()<r.scrollSensitivity?c=t(s).scrollLeft(t(s).scrollLeft()-r.scrollSpeed):t(e).width()-(i.pageX-t(s).scrollLeft())<r.scrollSensitivity&&(c=t(s).scrollLeft(t(s).scrollLeft()+r.scrollSpeed)))}else console.warn("To use scrolling you need to have scrollParent() function, check documentation for more information");this.scrollTimer&&clearTimeout(this.scrollTimer),r.scroll&&c&&(this.scrollTimer=setTimeout(function(){t(e).trigger(i)},10)),d.dirAx!==h?(d.distAxX=0,d.distAxY=0):(d.distAxX+=Math.abs(d.distX),0!==d.dirX&&d.dirX!==d.lastDirX&&(d.distAxX=0),d.distAxY+=Math.abs(d.distY),0!==d.dirY&&d.dirY!==d.lastDirY&&(d.distAxY=0)),d.dirAx=h,d.dirAx&&d.distAxX>=r.threshold&&(d.distAxX=0,a=this.placeEl.prev(r.itemNodeName),d.distX>0&&a.length&&!a.hasClass(r.collapsedClass)&&!a.hasClass(r.noChildrenClass)&&(o=a.find(r.listNodeName).last(),this.placeEl.parents(r.listNodeName).length+this.dragDepth<=r.maxDepth&&(o.length?(o=a.children(r.listNodeName).last()).append(this.placeEl):this.createSubLevel(a,this.placeEl))),d.distX<0&&(this.placeEl.next(r.itemNodeName).length||(n=this.placeEl.parent(),this.placeEl.closest(r.itemNodeName).after(this.placeEl),n.children().length||this.unsetParent(n.parent()))));var f=!1;if(l||(this.dragEl[0].style.visibility="hidden"),this.pointEl=t(s.elementFromPoint(i.pageX-s.body.scrollLeft,i.pageY-(e.pageYOffset||s.documentElement.scrollTop))),l||(this.dragEl[0].style.visibility="visible"),this.pointEl.hasClass(r.handleClass)&&(this.pointEl=this.pointEl.closest(r.itemNodeName)),this.pointEl.hasClass(r.emptyClass))f=!0;else if(!this.pointEl.length||!this.pointEl.hasClass(r.itemClass))return;var u=this.pointEl.closest("."+r.rootClass),m=this.dragRootEl.data("nestable-id")!==u.data("nestable-id");if(!d.dirAx||m||f){if(m&&r.group!==u.data("nestable-group"))return;if(this.options.fixedDepth&&this.dragDepth+1!==this.pointEl.parents(r.listNodeName).length)return;if(this.dragDepth-1+this.pointEl.parents(r.listNodeName).length>r.maxDepth)return;var g=i.pageY<this.pointEl.offset().top+this.pointEl.height()/2;n=this.placeEl.parent(),f?((o=t(s.createElement(r.listNodeName)).addClass(r.listClass)).append(this.placeEl),this.pointEl.replaceWith(o)):g?this.pointEl.before(this.placeEl):this.pointEl.after(this.placeEl),n.children().length||this.unsetParent(n.parent()),this.dragRootEl.find(r.itemNodeName).length||this.appendEmptyElement(this.dragRootEl),this.dragRootEl=u,m&&(this.hasNewRoot=this.el[0]!==this.dragRootEl[0])}},appendEmptyElement:function(t){t.append('<div class="'+this.options.emptyClass+'"/>')}},t.fn.nestable=function(s){var i=this,n=this,l=arguments;return"Nestable"in e||(e.Nestable={},Nestable.counter=0),i.each(function(){var e=t(this).data("nestable");if(e){if("string"==typeof s&&"function"==typeof e[s])if(l.length>1){for(var i=[],a=1;a<l.length;a++)i.push(l[a]);n=e[s].apply(e,i)}else n=e[s]()}else Nestable.counter++,t(this).data("nestable",new o(this,s)),t(this).data("nestable-id",Nestable.counter)}),n||i}}(window.jQuery||window.Zepto,window,document);
/*
Copyright (c) 2019 Daybrush
name: moveable
license: MIT
author: Daybrush
repository: https://github.com/daybrush/moveable/blob/master/packages/moveable
version: 0.36.1
*/
!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):(t="undefined"!=typeof globalThis?globalThis:t||self).Moveable=e()}(this,function(){"use strict";var a=function(t,e){return(a=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(t,e){t.__proto__=e}||function(t,e){for(var n in e)e.hasOwnProperty(n)&&(t[n]=e[n])})(t,e)};function s(t,e){function n(){this.constructor=t}a(t,e),t.prototype=null===e?Object.create(e):(n.prototype=e.prototype,new n)}var u=function(){return(u=Object.assign||function(t){for(var e,n=1,r=arguments.length;n<r;n++)for(var i in e=arguments[n])Object.prototype.hasOwnProperty.call(e,i)&&(t[i]=e[i]);return t}).apply(this,arguments)};function S(e,n){return function(t){t&&(e[n]=t)}}function c(e,n,r){return function(t){t&&(e[n][r]=t)}}function l(n,r){return function(t){var e=t.prototype;n.forEach(function(t){r(e,t)})}}var M=function(){function t(){this.keys=[],this.values=[]}var e=t.prototype;return e.get=function(t){return this.values[this.keys.indexOf(t)]},e.set=function(t,e){var n=this.keys,r=this.values,i=n.indexOf(t),i=-1===i?n.length:i;n[i]=t,r[i]=e},t}(),w=function(){function t(){this.object={}}var e=t.prototype;return e.get=function(t){return this.object[t]},e.set=function(t,e){this.object[t]=e},t}(),R="function"==typeof Map,f=function(){function t(){}var e=t.prototype;return e.connect=function(t,e){this.prev=t,this.next=e,t&&(t.next=this),e&&(e.prev=this)},e.disconnect=function(){var t=this.prev,e=this.next;t&&(t.next=e),e&&(e.prev=t)},e.getIndex=function(){for(var t=this,e=-1;t;)t=t.prev,++e;return e},t}();var O=function(){function t(t,e,n,r,i,o,a,s){this.prevList=t,this.list=e,this.added=n,this.removed=r,this.changed=i,this.maintained=o,this.changedBeforeAdded=a,this.fixed=s}var e=t.prototype;return Object.defineProperty(e,"ordered",{get:function(){return this.cacheOrdered||this.caculateOrdered(),this.cacheOrdered},enumerable:!0,configurable:!0}),Object.defineProperty(e,"pureChanged",{get:function(){return this.cachePureChanged||this.caculateOrdered(),this.cachePureChanged},enumerable:!0,configurable:!0}),e.caculateOrdered=function(){t=this.changedBeforeAdded,n=this.fixed,i=[],o=[],t.forEach(function(t){var e=t[0],t=t[1],n=new f;i[e]=n,o[t]=n}),i.forEach(function(t,e){t.connect(i[e-1])});var n,i,o,t=t.filter(function(t,e){return!n[e]}).map(function(t,e){var n=t[0],t=t[1];if(n===t)return[0,0];var n=i[n],t=o[t-1],r=n.getIndex();return n.disconnect(),t?n.connect(t,t.next):n.connect(void 0,i[0]),[r,n.getIndex()]}),a=this.changed,s=[];this.cacheOrdered=t.filter(function(t,e){var n=t[0],t=t[1],e=a[e],r=e[0],e=e[1];if(n!==t)return s.push([r,e]),!0}),this.cachePureChanged=s},t}();function _(t,e,n){var r=R?Map:n?w:M,n=n||function(t){return t},i=[],o=[],a=[],s=t.map(n),n=e.map(n),u=new r,c=new r,l=[],f=[],p={},d=[],h=0,g=0;return s.forEach(function(t,e){u.set(t,e)}),n.forEach(function(t,e){c.set(t,e)}),s.forEach(function(t,e){t=c.get(t);void 0===t?(++g,o.push(e)):p[t]=g}),n.forEach(function(t,e){t=u.get(t);void 0===t?(i.push(e),++h):(a.push([t,e]),g=p[e]||0,l.push([t-g,e-h]),f.push(e===t),t!==e&&d.push([t,e]))}),o.reverse(),new O(t,e,i,o,d,a,l,f)}var d=function(){function t(t,e){void 0===t&&(t=[]),this.findKeyCallback=e,this.list=[].slice.call(t)}return t.prototype.update=function(t){var t=[].slice.call(t),e=_(this.list,t,this.findKeyCallback);return this.list=t,e},t}(),h="function",g="object",z="string",L="number",H="undefined",V=typeof window!==H,U=[{open:"(",close:")"},{open:'"',close:'"'},{open:"'",close:"'"},{open:'\\"',close:'\\"'},{open:"\\'",close:"\\'"}],k=1e-7,$={cm:function(t){return 96*t/2.54},mm:function(t){return 96*t/254},in:function(t){return 96*t},pt:function(t){return 96*t/72},pc:function(t){return 96*t/6},"%":function(t,e){return t*e/100},vw:function(t,e){return t/100*(e=void 0===e?window.innerWidth:e)},vh:function(t,e){return t/100*(e=void 0===e?window.innerHeight:e)},vmax:function(t,e){return t/100*(e=void 0===e?Math.max(window.innerWidth,window.innerHeight):e)},vmin:function(t,e){return t/100*(e=void 0===e?Math.min(window.innerWidth,window.innerHeight):e)}};function rt(t,e,n,r){return(t*r+e*n)/(n+r)}function it(t){return typeof t===H}function ot(t){return t&&typeof t===g}function D(t){return Array.isArray(t)}function b(t){return typeof t===z}function at(t){return typeof t===L}function st(t){return typeof t===h}function ut(t,e,n,r,i){if(ct(t,e,n))return n;for(var o,a=t,s=e,u=r,c=i,l=n+1;l<u;++l){var f=function(t){var e,n,r=s[t].trim();return r!==a.close||ct(a,s,t)?(e=t,-1===(e=(n=bt(c,function(t){return t.open===r}))?ut(n,s,t,u,c):e)?(o=t,"break"):void(o=t=e)):{value:t}}(l);if(l=o,"object"==typeof f)return f.value;if("break"===f)break}return-1}function ct(t,e,n){if(!t.ignore)return null;e=e.slice(Math.max(n-3,0),n+3).join("");return new RegExp(t.ignore).exec(e)}function lt(o,t){var t=b(t)?{separator:t}:t,e=t.separator,a=void 0===e?",":e,s=t.isSeparateFirst,u=t.isSeparateOnlyOpenClose,e=t.isSeparateOpenClose,c=void 0===e?u:e,e=t.openCloseCharacters,l=void 0===e?U:e,t=l.map(function(t){var e=t.open,t=t.close;return e===t?e:e+"|"+t}).join("|"),e=new RegExp("(\\s*"+a+"\\s*|"+t+"|\\s+)","g"),f=o.split(e).filter(Boolean),p=f.length,d=[],h=[];function g(){return h.length&&(d.push(h.join("")),h=[])}for(var v,n=function(t){var e=f[t].trim(),n=t,r=bt(l,function(t){return t.open===e}),i=bt(l,function(t){return t.close===e});if(r){if(-1!==(n=ut(r,f,t,p,l))&&c)return g()&&s?(v=t,"break"):(d.push(f.slice(t,n+1).join("")),t=n,s?(v=t,"break"):(v=t,"continue"))}else{if(i&&!ct(i,f,t))return(r=function(){for(var t=0,e=0,n=arguments.length;e<n;e++)t+=arguments[e].length;for(var r=Array(t),i=0,e=0;e<n;e++)for(var o=arguments[e],a=0,s=o.length;a<s;a++,i++)r[i]=o[a];return r}(l)).splice(l.indexOf(i),1),{value:lt(o,{separator:a,isSeparateFirst:s,isSeparateOnlyOpenClose:u,isSeparateOpenClose:c,openCloseCharacters:r})};if(i=e,!((""!==(r=a)&&" "!=r||""!==i&&" "!=i)&&i!==r||u))return g(),s?(v=t,"break"):(v=t,"continue")}h.push(f.slice(t,(n=-1===n?p-1:n)+1).join("")),v=t=n},r=0;r<p;++r){var i=n(r),r=v;if("object"==typeof i)return i.value;if("break"===i)break}return h.length&&d.push(h.join("")),d}function ft(t){return lt(t,"")}function pt(t){return lt(t,",")}function dt(t){t=/([^(]*)\(([\s\S]*)\)([\s\S]*)/g.exec(t);return!t||t.length<4?{}:{prefix:t[1],value:t[2],suffix:t[3]}}function ht(t){t=/^([^\d|e|\-|\+]*)((?:\d|\.|-|e-|e\+)+)(\S*)$/g.exec(t);if(!t)return{prefix:"",unit:"",value:NaN};var e=t[1],n=t[2];return{prefix:e,unit:t[3],value:parseFloat(n)}}function gt(t,r){return void 0===r&&(r="-"),t.replace(/([a-z])([A-Z])/g,function(t,e,n){return""+e+r+n.toLowerCase()})}function vt(){return Date.now?Date.now():(new Date).getTime()}function mt(t,e,n){void 0===n&&(n=-1);for(var r=t.length,i=0;i<r;++i)if(e(t[i],i,t))return i;return n}function bt(t,e,n){e=mt(t,e);return-1<e?t[e]:n}var xt=function(){var n=vt(),t=V&&(window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.msRequestAnimationFrame);return t?t.bind(window):function(t){var e=vt();return window.setTimeout(function(){t(e-n)},1e3/60)}}(),Et=function(){var t=V&&(window.cancelAnimationFrame||window.webkitCancelAnimationFrame||window.mozCancelAnimationFrame||window.msCancelAnimationFrame);return t?t.bind(window):function(t){clearTimeout(t)}}();function yt(t){return Object.keys(t)}function Z(t,e){var t=ht(t),n=t.value,t=t.unit;if(ot(e)){var r=e[t];if(r){if(st(r))return r(n);if($[t])return $[t](n,r)}}else if("%"===t)return n*e/100;return $[t]?$[t](n):n}function St(t,e,n){return Math.max(e,Math.min(t,n))}function Mt(t,r,i,e){return void 0===e&&(e=t[0]/t[1]),[[N(r[0],k),N(r[0]/e,k)],[N(r[1]*e,k),N(r[1],k)]].filter(function(t){return t.every(function(t,e){var e=r[e],n=N(e,k);return i?t<=e||t<=n:e<=t||n<=t})})[0]||t}function Ct(t){for(var e=t.length,n=0,r=e-1;0<=r;--r)n+=t[r];return e?n/e:0}function I(t,e){var n=e[0]-t[0],e=e[1]-t[1],t=Math.atan2(e,n);return 0<=t?t:t+2*Math.PI}function wt(t){n=t;var n,e=[0,1].map(function(e){return Ct(n.map(function(t){return t[e]}))}),r=I(e,t[0]),e=I(e,t[1]);return r<e&&e-r<Math.PI||e<r&&e-r<-Math.PI?1:-1}function C(t,e){return Math.sqrt(Math.pow((e?e[0]:0)-t[0],2)+Math.pow((e?e[1]:0)-t[1],2))}function N(t,e){if(!e)return t;var n=1/e;return Math.round(t/e)/n}function Dt(n,r){n.forEach(function(t,e){n[e]=N(n[e],r)})}function P(t,e){return t.classList?t.classList.contains(e):!!t.className.match(new RegExp("(\\s|^)"+e+"(\\s|$)"))}function v(t,e,n,r){t.addEventListener(e,n,r)}function m(t,e,n,r){t.removeEventListener(e,n,r)}var Rt=function(t,e){return(Rt=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(t,e){t.__proto__=e}||function(t,e){for(var n in e)e.hasOwnProperty(n)&&(t[n]=e[n])})(t,e)};function Ot(t,e){function n(){this.constructor=t}Rt(t,e),t.prototype=null===e?Object.create(e):(n.prototype=e.prototype,new n)}var _t=function(){return(_t=Object.assign||function(t){for(var e,n=1,r=arguments.length;n<r;n++)for(var i in e=arguments[n])Object.prototype.hasOwnProperty.call(e,i)&&(t[i]=e[i]);return t}).apply(this,arguments)};function Pt(t,e){var n={};for(i in t)Object.prototype.hasOwnProperty.call(t,i)&&e.indexOf(i)<0&&(n[i]=t[i]);if(null!=t&&"function"==typeof Object.getOwnPropertySymbols)for(var r=0,i=Object.getOwnPropertySymbols(t);r<i.length;r++)e.indexOf(i[r])<0&&Object.prototype.propertyIsEnumerable.call(t,i[r])&&(n[i[r]]=t[i[r]]);return n}function Bt(t,e){if(t===e)return!1;for(var n in t)if(!(n in e))return!0;for(var n in e)if(t[n]!==e[n])return!0;return!1}function zt(n,r){var i=Object.keys(n),e=Object.keys(r),t=_(i,e,function(t){return t}),o={},a={},s={};return t.added.forEach(function(t){t=e[t];o[t]=r[t]}),t.removed.forEach(function(t){t=i[t];a[t]=n[t]}),t.maintained.forEach(function(t){var t=t[0],t=i[t],e=[n[t],r[t]];n[t]!==r[t]&&(s[t]=e)}),{added:o,removed:a,changed:s}}function Tt(t){t.forEach(function(t){t()})}function Gt(t){var e=0;return t.map(function(t){return null==t?"$compat"+ ++e:""+t})}function kt(t,e,n,r){return b(t)||at(t)?new jt("text_"+t,e,n,r,null,{}):new("string"==typeof t.type?Yt:t.type.prototype.render?Ht:qt)(t.type,e,n,r,t.ref,t.props)}function At(t){var e=t.className,t=Pt(t,["className"]);return null!=e&&(t.class=e),delete t.style,delete t.children,t}function Ft(t,e){if(!e)return t;for(var n in e)it(t[n])&&(t[n]=e[n]);return t}function x(t,e){for(var n=[],r=2;r<arguments.length;r++)n[r-2]=arguments[r];var e=e||{},i=e.key,o=e.ref,e=Pt(e,["key","ref"]);return{type:t,key:i,ref:o,props:_t(_t({},e),{children:function e(t){var n=[];return t.forEach(function(t){n=n.concat(D(t)?e(t):t)}),n}(n).filter(function(t){return null!=t&&!1!==t})})}}var It=function(){function t(t,e,n,r,i,o){void 0===o&&(o={}),this.type=t,this.key=e,this.index=n,this.container=r,this.ref=i,this.props=o,this._providers=[]}var e=t.prototype;return e._should=function(t,e){return!0},e._update=function(t,e,n,r){if(this.base&&!b(e)&&!r&&!this._should(e.props,n))return!1;this.original=e,this._setState(n);r=this.props;return b(e)||(this.props=e.props,this.ref=e.ref),this._render(t,this.base?r:{},n),!0},e._mounted=function(){var t=this.ref;t&&t(this.base)},e._setState=function(t){},e._updated=function(){var t=this.ref;t&&t(this.base)},e._destroy=function(){var t=this.ref;t&&t(null)},t}();function Nt(t){var e,n={},r={};for(e in t)0===e.indexOf("on")?r[e.replace("on","").toLowerCase()]=t[e]:n[e]=t[e];return{attributes:n,events:r}}var jt=function(t){function e(){return null!==t&&t.apply(this,arguments)||this}Ot(e,t);var n=e.prototype;return n._render=function(t){var e=this,n=!this.base;return n&&(this.base=document.createTextNode(this.type.replace("text_",""))),t.push(function(){n?e._mounted():e._updated()}),!0},n._unmount=function(){this.base.parentNode.removeChild(this.base)},e}(It),Yt=function(e){function t(){var t=null!==e&&e.apply(this,arguments)||this;return t.events={},t._isSVG=!1,t}Ot(t,e);var n=t.prototype;return n.addEventListener=function(t,e){var n=this.events;n[t]=function(t){t.nativeEvent=t,e(t)},this.base.addEventListener(t,n[t])},n.removeEventListener=function(t){var e=this.events;this.base.removeEventListener(t,e[t]),delete e[t]},n._should=function(t){return Bt(this.props,t)},n._render=function(t,e){var n,r=this,i=!this.base,o=(i&&(o=this._hasSVG(),this._isSVG=o,(s=this.props.portalContainer)||(a=this.type,s=o?document.createElementNS("http://www.w3.org/2000/svg",a):document.createElement(a)),this.base=s),Zt(this,this._providers,this.props.children,t,null),this.base),a=Nt(e),s=a.attributes,a=a.events,u=Nt(this.props),c=u.attributes,u=u.events,s=At(s),c=At(c),l=o,f=(s=zt(s,c)).added,c=s.removed,p=s.changed;for(n in f)l.setAttribute(n,f[n]);for(n in p)l.setAttribute(n,p[n][1]);for(n in c)l.removeAttribute(n);var d,c=a,h=this,g=(c=zt(c,a=u)).added,a=c.removed,v=c.changed;for(d in a)h.removeEventListener(d);for(d in g)h.addEventListener(d,g[d]);for(d in v)h.removeEventListener(d),h.addEventListener(d,v[d][1]);for(d in a)h.removeEventListener(d);var m,u=e.style||{},c=this.props.style||{},e=o,b=e.style,x=(e=zt(u,c)).added,u=e.removed,E=e.changed;for(m in x){var y=gt(m,"-");b.setProperty?b.setProperty(y,x[m]):b[y]=x[m]}for(m in E){y=gt(m,"-");b.setProperty?b.setProperty(y,E[m][1]):b[y]=E[m][1]}for(m in u){y=gt(m,"-");b.removeProperty?b.removeProperty(y):b[y]=""}return t.push(function(){i?r._mounted():r._updated()}),!0},n._unmount=function(){var t,e=this.events,n=this.base;for(t in e)n.removeEventListener(t,e[t]);this._providers.forEach(function(t){t._unmount()}),this.events={},this.props.portalContainer||n.parentNode.removeChild(n)},n._hasSVG=function(){if(this._isSVG||"svg"===this.type)return!0;var t=Xt(this.container);return t&&"ownerSVGElement"in t},t}(It);function Xt(t){if(!t)return null;var e=t.base;return e instanceof Node?e:Xt(t.container)}function Wt(t){if(!t)return null;if(t instanceof Node)return t;t=t.$_provider._providers;return t.length?Wt(t[0].base):null}var qt=function(t){function e(){return null!==t&&t.apply(this,arguments)||this}Ot(e,t);var n=e.prototype;return n._render=function(t){var e=this.type(this.props);return Zt(this,this._providers,e?[e]:[],t),!0},n._unmount=function(){this._providers.forEach(function(t){t._unmount()})},e}(It),Lt=function(n){function t(t){var e=n.call(this,"container","container",0,null)||this;return e.base=t,e}Ot(t,n);var e=t.prototype;return e._render=function(){return!0},e._unmount=function(){},t}(It),Ht=function(a){function t(t,e,n,r,i,o){return a.call(this,t,e,n,r,i,Ft(o=void 0===o?{}:o,t.defaultProps))||this}Ot(t,a);var e=t.prototype;return e._should=function(t,e){return this.base.shouldComponentUpdate(Ft(t,this.type.defaultProps),e||this.base.state)},e._render=function(t,e){var n=this,r=(this.props=Ft(this.props,this.type.defaultProps),!this.base),i=(r?(this.base=new this.type(this.props),this.base.$_provider=this):this.base.props=this.props,this.base),o=i.state,a=i.render();a&&a.props&&!a.props.children.length&&(a.props.children=this.props.children),Zt(this,this._providers,a?[a]:[],t),t.push(function(){r?(n._mounted(),i.componentDidMount()):(n._updated(),i.componentDidUpdate(e,o))})},e._setState=function(t){var e=this.base;e&&t&&(e.state=t)},e._unmount=function(){this._providers.forEach(function(t){t._unmount()}),clearTimeout(this.base.$_timer),this.base.componentWillUnmount()},t}(It),It=function(){function t(t){this.props=t=void 0===t?{}:t,this.state={},this.$_timer=0,this.$_state={}}var e=t.prototype;return e.shouldComponentUpdate=function(t,e){return!0},e.render=function(){return null},e.setState=function(t,e,n){var r=this;this.$_timer||(this.$_state={}),clearTimeout(this.$_timer),this.$_timer=0,this.$_state=_t(_t({},this.$_state),t),n?this.$_setState(e,n):this.$_timer=setTimeout(function(){r.$_timer=0,r.$_setState(e,n)})},e.forceUpdate=function(t){this.setState({},t,!0)},e.componentDidMount=function(){},e.componentDidUpdate=function(t,e){},e.componentWillUnmount=function(){},e.$_setState=function(t,e){var n=[],r=this.$_provider;Zt(r.container,[r],[r.original],n,_t(_t({},this.state),this.$_state),e)&&(t&&n.push(t),Tt(n))},t}(),Vt=function(t){function e(){return null!==t&&t.apply(this,arguments)||this}return Ot(e,t),e.prototype.shouldComponentUpdate=function(t,e){return Bt(this.props,t)||Bt(this.state,e)},e}(It),Ut=function(t){function e(){return null!==t&&t.apply(this,arguments)||this}Ot(e,t);var n=e.prototype;return n.componentDidMount=function(){var t=this.props,e=t.element,t=t.container;this._portalProvider=new Lt(t),Kt(e,t,this._portalProvider)},n.componentDidUpdate=function(){var t=this.props;Kt(t.element,t.container,this._portalProvider)},n.componentWillUnmount=function(){Kt(null,this.props.container,this._portalProvider),this._portalProvider=null},e}(Vt);function $t(r,i,o){var a=o.map(function(t){return b(t)?null:t.key}),t=_(Gt(i.map(function(t){return t.key})),Gt(a),function(t){return t}),e=(t.removed.forEach(function(t){i.splice(t,1)[0]._unmount()}),t.ordered.forEach(function(t){var e=t[0],t=t[1],e=i.splice(e,1)[0],e=(i.splice(t,0,e),Wt(e.base)),t=Wt(i[t+1]&&i[t+1].base);e&&e.parentNode.insertBefore(e,t)}),t.added.forEach(function(t){i.splice(t,0,kt(o[t],a[t],t,r))}),t.maintained.filter(function(t){t[0];var t=t[1],e=o[t],n=i[t];return(b(e)?"text_"+e:e.type)!==n.type?(n._unmount(),i.splice(t,1,kt(e,a[t],t,r)),!0):(n.index=t,!1)}));return function(){for(var t=0,e=0,n=arguments.length;e<n;e++)t+=arguments[e].length;for(var r=Array(t),i=0,e=0;e<n;e++)for(var o=arguments[e],a=0,s=o.length;a<s;a++,i++)r[i]=o[a];return r}(t.added,e.map(function(t){return t[0],t[1]}))}function Zt(n,r,i,o,a,s){var t=$t(n,r,i),e=r.filter(function(t,e){return t._update(o,i[e],a,s)}),u=Xt(n);return u&&t.reverse().forEach(function(t){var t=r[t],e=Wt(t.base);e&&u!==e&&!e.parentNode&&(t=function(t,e){for(var n=t._providers,r=n.length,i=e.index+1;i<r;++i){var o=Wt(n[i].base);if(o)return o}return null}(n,t),u.insertBefore(e,t))}),0<e.length}function Kt(t,e,n){var r,i,o=!!(n=void 0===n?e.__REACT_COMPAT__:n);n=n||new Lt(e),t=t?[t]:[],i=[],Zt(n,n._providers,t,i,r),Tt(i),o||(e.__REACT_COMPAT__=n)}function Jt(t,e,n){var r=e.__REACT_COMPAT__;t&&!r&&(e.innerHTML=""),Kt(t,e,r),n&&n()}function Qt(t,e){for(var n=t.length,r=0;r<n;++r)if(e(t[r],r))return!0;return!1}function te(t,e){for(var n=t.length,r=0;r<n;++r)if(e(t[r],r))return t[r];return null}function ee(t){if(void 0===t){if("undefined"==typeof navigator||!navigator)return"";t=navigator.userAgent||""}return t.toLowerCase()}function ne(t,e){try{return new RegExp(t,"g").exec(e)}catch(t){return null}}function re(t){return t.replace(/_/g,".")}function ie(t,n){var r=null,i="-1";return Qt(t,function(t){var e=ne("("+t.test+")((?:\\/|\\s|:)([0-9|\\.|_]+))?",n);if(e&&!t.brand)return r=t,i=e[3]||"-1",t.versionAlias?i=t.versionAlias:t.versionTest&&(e=t.versionTest.toLowerCase(),i=((e=ne("("+e+")((?:\\/|\\s|:)([0-9|\\.|_]+))",n))?e[3]:"")||i),i=re(i),1}),{preset:r,version:i}}function oe(t,n){var r={brand:"",version:"-1"};return Qt(t,function(t){var e=ae(n,t);return e&&(r.brand=t.id,r.version=t.versionAlias||e.version,"-1"!==r.version)}),r}function ae(t,e){return te(t,function(t){t=t.brand;return ne(""+e.test,t.toLowerCase())})}var t=[{test:"phantomjs",id:"phantomjs"},{test:"whale",id:"whale"},{test:"edgios|edge|edg",id:"edge"},{test:"msie|trident|windows phone",id:"ie",versionTest:"iemobile|msie|rv"},{test:"miuibrowser",id:"miui browser"},{test:"samsungbrowser",id:"samsung internet"},{test:"samsung",id:"samsung internet",versionTest:"version"},{test:"chrome|crios",id:"chrome"},{test:"firefox|fxios",id:"firefox"},{test:"android",id:"android browser",versionTest:"version"},{test:"safari|iphone|ipad|ipod",id:"safari",versionTest:"version"}],se=[{test:"(?=.*applewebkit/(53[0-7]|5[0-2]|[0-4]))(?=.*\\schrome)",id:"chrome",versionTest:"chrome"},{test:"chromium",id:"chrome"},{test:"whale",id:"chrome",versionAlias:"-1",brand:!0}],ue=[{test:"applewebkit",id:"webkit",versionTest:"applewebkit|safari"}],ce=[{test:"(?=(iphone|ipad))(?!(.*version))",id:"webview"},{test:"(?=(android|iphone|ipad))(?=.*(naver|daum|; wv))",id:"webview"},{test:"webview",id:"webview"}],le=[{test:"windows phone",id:"windows phone"},{test:"windows 2000",id:"window",versionAlias:"5.0"},{test:"windows nt",id:"window"},{test:"win32|windows",id:"window"},{test:"iphone|ipad|ipod",id:"ios",versionTest:"iphone os|cpu os"},{test:"macos|macintel|mac os x",id:"mac"},{test:"android|linux armv81",id:"android"},{test:"tizen",id:"tizen"},{test:"webos|web0s",id:"webos"}];function fe(t){return!!ie(ce,t).preset}function pe(t,e,n){void 0===n&&(n=Math.sqrt(t.length));for(var r=t.slice(),i=0;i<n;++i)r[i*n+e-1]=0,r[(e-1)*n+i]=0;return r[(e-1)*(n+1)]=1,r}function de(t,e){void 0===e&&(e=Math.sqrt(t.length));for(var n=t.slice(),r=Y(e),i=0;i<e;++i){var o=e*i+i;if(!N(n[o],k))for(var a=i+1;a<e;++a)if(n[e*i+a]){v=g=h=d=p=f=l=c=u=s=void 0;for(var s=n,u=r,c=i,l=a,f=e,p=0;p<f;++p){var d=c+p*f,h=l+p*f,g=s[d],v=u[d];s[d]=s[h],s[h]=g,u[d]=u[h],u[h]=v}break}if(!N(n[o],k))return[];M=S=y=E=x=b=m=void 0;for(var m=n,b=r,x=i,E=e,y=n[o],S=0;S<E;++S){var M=x+S*E;m[M]/=y,b[M]/=y}for(a=0;a<e;++a){var C=a,w=n[a+i*e];if(N(w,k)&&i!==a){G=T=z=B=P=_=O=R=D=void 0;for(var D=n,R=r,O=C,_=i,P=e,B=-w,z=0;z<P;++z){var T=O+z*P,G=_+z*P;D[T]+=D[G]*B,R[T]+=R[G]*B}}}}return r}function he(t,e){for(var n=[],r=t[(e=void 0===e?Math.sqrt(t.length):e)*e-1],i=0;i<e-1;++i)n[i]=t[e*(e-1)+i]/r;return n[e-1]=0,n}function ge(t,e){for(var n=t.slice(),r=t.length;r<e-1;++r)n[r]=0;return n[e-1]=1,n}function ve(t,e,n){if((e=void 0===e?Math.sqrt(t.length):e)===n)return t;for(var r=Y(n),i=Math.min(e,n),o=0;o<i-1;++o){for(var a=0;a<i-1;++a)r[o*n+a]=t[o*e+a];r[(o+1)*n-1]=t[(o+1)*e-1],r[(n-1)*n+o]=t[(e-1)*e+o]}return r[n*n-1]=t[e*e-1],r}function me(e){for(var t=[],n=1;n<arguments.length;n++)t[n-1]=arguments[n];var r=Y(e);return t.forEach(function(t){r=K(r,t,e)}),r}function K(t,e,n){void 0===n&&(n=Math.sqrt(t.length));var r=[],i=t.length/n,o=e.length/i;if(!i)return e;if(!o)return t;for(var a=0;a<n;++a)for(var s=0;s<o;++s)for(var u=r[s*n+a]=0;u<i;++u)r[s*n+a]+=t[u*n+a]*e[s*i+u];return r}function J(t,e){for(var n=Math.min(t.length,e.length),r=t.slice(),i=0;i<n;++i)r[i]=r[i]+e[i];return r}function T(t,e){for(var n=Math.min(t.length,e.length),r=t.slice(),i=0;i<n;++i)r[i]=r[i]-e[i];return r}function be(t,e){return(e=void 0===e?9===t.length:e)?[t[0],t[1],t[3],t[4],t[6],t[7]]:t}function B(t,e,n){var t=K(t,e,n=void 0===n?e.length:n),r=t[n-1];return t.map(function(t){return t/r})}function xe(t,e){return K(t,[1,0,0,0,0,Math.cos(e),Math.sin(e),0,0,-Math.sin(e),Math.cos(e),0,0,0,0,1],4)}function Ee(t,e){return K(t,[Math.cos(e),0,-Math.sin(e),0,0,1,0,0,Math.sin(e),0,Math.cos(e),0,0,0,0,1],4)}function ye(t,e){return K(t,De(e,4))}function Se(t,e){var n=e[0],r=e[1],e=e[2];return K(t,[void 0===n?1:n,0,0,0,0,void 0===r?1:r,0,0,0,0,void 0===e?1:e,0,0,0,0,1],4)}function Me(t,e){return B(De(e,3),ge(t,3))}function Ce(t,e){var n=e[0],r=e[1],e=e[2];return K(t,[1,0,0,0,0,1,0,0,0,0,1,0,void 0===n?0:n,void 0===r?0:r,void 0===e?0:e,1],4)}function we(t,e){return K(t,e,4)}function De(t,e){var n=Math.cos(t),t=Math.sin(t),r=Y(e);return r[0]=n,r[1]=t,r[e]=-t,r[e+1]=n,r}function Y(t){for(var e=t*t,n=[],r=0;r<e;++r)n[r]=r%(t+1)?0:1;return n}function Re(t,e){for(var n=Y(e),r=Math.min(t.length,e-1),i=0;i<r;++i)n[(e+1)*i]=t[i];return n}function Oe(t,e){for(var n=Y(e),r=Math.min(t.length,e-1),i=0;i<r;++i)n[e*(e-1)+i]=t[i];return n}function _e(t,e,n,r,i,o,a,s){var u=t[0],t=t[1],c=e[0],e=e[1],l=n[0],n=n[1],f=r[0],r=r[1],p=i[0],i=i[1],d=o[0],o=o[1],h=a[0],a=a[1],g=s[0],s=s[1],u=de([u,0,c,0,l,0,f,0,t,0,e,0,n,0,r,0,1,0,1,0,1,0,1,0,0,u,0,c,0,l,0,f,0,t,0,e,0,n,0,r,0,1,0,1,0,1,0,1,-p*u,-i*u,-d*c,-o*c,-h*l,-a*l,-g*f,-s*f,-p*t,-i*t,-d*e,-o*e,-h*n,-a*n,-g*r,-s*r],8);if(!u.length)return[];c=K(u,[p,i,d,o,h,a,g,s],8);return c[8]=1,ve(function(t,e){void 0===e&&(e=Math.sqrt(t.length));for(var n=[],r=0;r<e;++r)for(var i=0;i<e;++i)n[i*e+r]=t[e*r+i];return n}(c),3,4)}function Pe(t){return Be(ze(t))}function Be(t){var n=[1,0,0,0,0,1,0,0,0,0,1,0,0,0,0,1];return t.forEach(function(t){var e=t.matrixFunction,t=t.functionValue;e&&(n=e(n,t))}),n}function ze(t){return(D(t)?t:ft(t)).map(function(t){var e,n,r,t=dt(t),i=t.prefix,t=t.value,o=null,a=i,s="";return"translate"===i||"translateX"===i||"translate3d"===i?(o=Ce,s=[(r=pt(t).map(function(t){return parseFloat(t)}))[0],void 0===(e=r[1])?0:e,void 0===(e=r[2])?0:e]):"translateY"===i?(o=Ce,s=[0,parseFloat(t),0]):"translateZ"===i?(o=Ce,s=[0,0,parseFloat(t)]):"scale"===i||"scale3d"===i?(o=Se,s=[n=(r=pt(t).map(function(t){return parseFloat(t)}))[0],void 0===(e=r[1])?n:e,void 0===(e=r[2])?1:e]):"scaleX"===i?(o=Se,s=[n=parseFloat(t),1,1]):"scaleY"===i?(o=Se,s=[1,parseFloat(t),1]):"scaleZ"===i?(o=Se,s=[1,1,parseFloat(t)]):"rotate"===i||"rotateZ"===i||"rotateX"===i||"rotateY"===i?(e=(r=ht(t)).unit,n=r.value,"rotate"===i||"rotateZ"===i?(a="rotateZ",o=ye):"rotateX"===i?o=xe:"rotateY"===i&&(o=Ee),s="rad"===e?n:n*Math.PI/180):"matrix3d"===i?(o=we,s=pt(t).map(function(t){return parseFloat(t)})):"matrix"===i?(o=we,s=[(r=pt(t).map(function(t){return parseFloat(t)}))[0],r[1],0,0,r[2],r[3],0,0,0,0,1,0,r[4],r[5],0,1]):a="",{name:i,functionName:a,value:t,matrixFunction:o,functionValue:s}})}var Te=function(t,e){return(Te=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(t,e){t.__proto__=e}||function(t,e){for(var n in e)e.hasOwnProperty(n)&&(t[n]=e[n])})(t,e)};var Ge,ke="function"==typeof Map?void 0:(Ge=0,function(t){return t.__DIFF_KEY__||(t.__DIFF_KEY__=++Ge)}),Ae=function(e){function t(){this.constructor=n}var n,r;function i(t){return e.call(this,t=void 0===t?[]:t,ke)||this}return Te(n=i,r=e),n.prototype=null===r?Object.create(r):(t.prototype=r.prototype,new t),i}(d);function p(t){return N(t,k)}function Fe(n){return n.length<3?0:Math.abs(function(t){for(var e=0,n=t.length-1;0<=n;--n)e+=t[n];return e}(n.map(function(t,e){e=n[e+1]||n[0];return t[0]*e[1]-e[0]*t[1]})))/2}function Ie(t,e){var n=e.width,r=e.height,i=e.left,o=e.top,e=Ne(t),a=e.minX,s=e.minY,u=e.maxX,e=e.maxY,c=n/(u-a),l=r/(e-s);return t.map(function(t){return[i+(t[0]-a)*c,o+(t[1]-s)*l]})}function Ne(t){var e=t.map(function(t){return t[0]}),t=t.map(function(t){return t[1]});return{minX:Math.min.apply(Math,e),minY:Math.min.apply(Math,t),maxX:Math.max.apply(Math,e),maxY:Math.max.apply(Math,t)}}function je(i,t,e){var r=i[0],o=i[1],n=Ne(t),a=n.minX,n=n.maxX,s=[[a,o],[n,o]],u=Ye(s[0],s[1]),a=qe(t),c=[];if(a.forEach(function(t){var n,e=Ye(t[0],t[1]),r=t[0];n=e,u.every(function(t,e){return 0===p(t-n[e])})?c.push({pos:i,line:t,type:"line"}):We(Xe(u,e),[s,t]).forEach(function(n){t.some(function(t){return e=n,!p((t=t)[0]-e[0])&&!p(t[1]-e[1]);var e})?c.push({pos:n,line:t,type:"point"}):0!==p(r[1]-o)&&c.push({pos:n,line:t,type:"intersection"})})}),!e&&bt(c,function(t){return t[0]===r}))return!0;var l=0,f={};return c.forEach(function(t){var e=t.pos,n=t.type,t=t.line;e[0]>r||("intersection"===n?++l:"line"!==n&&"point"===n&&(n=bt(t,function(t){return t[1]!==o}),t=f[e[0]],n=n[1]>o?1:-1,t?t!==n&&++l:f[e[0]]=n))}),l%2==1}function Ye(t,e){var n=t[0],t=t[1],r=e[0]-n,e=e[1]-t,i=(Math.abs(r)<k&&(r=0),Math.abs(e)<k&&(e=0),0),o=0,a=0;return r?a=e?(o=1,-(i=-e/r)*n-t):(o=1,-t):e&&(i=-1,a=n),[i,o,a]}function Xe(t,e){var n,r,i=t[0],o=t[1],t=t[2],a=e[0],s=e[1],e=e[2],u=0===i&&0===a,c=0===o&&0===s;return u&&c?[]:u?(u=-t/o)!=-e/s?[]:[[-1/0,u],[1/0,u]]:c?(u=-t/i)!=-e/a?[]:[[u,-1/0],[u,1/0]]:(0===i?[[n=-(s*(r=-t/o)+e)/a,r]]:0===a?[[n=-(o*(r=-e/s)+t)/i,r]]:0===o?[[n=-t/i,r=-(a*n+e)/s]]:0===s?[[n=-e/a,r=-(i*n+t)/o]]:[[n=(o*e-s*t)/(s*i-o*a),r=-(i*n+t)/o]]).map(function(t){return[t[0],t[1]]})}function We(t,e){var r=e.map(function(e){return[0,1].map(function(t){return[Math.min(e[0][t],e[1][t]),Math.max(e[0][t],e[1][t])]})}),e=[];if(2===t.length){var n=t[0],i=n[0],n=n[1];if(p(i-t[1][0])){if(!p(n-t[1][1])){var o=Math.max.apply(Math,r.map(function(t){return t[0][0]})),a=Math.min.apply(Math,r.map(function(t){return t[0][1]}));if(0<p(o-a))return[];e=[[o,n],[a,n]]}}else{o=Math.max.apply(Math,r.map(function(t){return t[1][0]})),a=Math.min.apply(Math,r.map(function(t){return t[1][1]}));if(0<p(o-a))return[];e=[[i,o],[i,a]]}}return(e=e.length?e:t.filter(function(t){var e=t[0],n=t[1];return r.every(function(t){return 0<=p(e-t[0][0])&&0<=p(t[0][1]-e)&&0<=p(n-t[1][0])&&0<=p(t[1][1]-n)})})).map(function(t){return[p(t[0]),p(t[1])]})}function qe(n){return function(){for(var t=0,e=0,n=arguments.length;e<n;e++)t+=arguments[e].length;for(var r=Array(t),i=0,e=0;e<n;e++)for(var o=arguments[e],a=0,s=o.length;a<s;a++,i++)r[i]=o[a];return r}(n.slice(1),[n[0]]).map(function(t,e){return[n[e],t]})}function Le(t,e){var i,a,s,u,c,l,n;return e=e,i=(t=t).slice(),a=e.slice(),-1===wt(i)&&i.reverse(),-1===wt(a)&&a.reverse(),s=qe(i),u=qe(a),t=s.map(function(t){return Ye(t[0],t[1])}),c=u.map(function(t){return Ye(t[0],t[1])}),l=[],t.forEach(function(n,r){var i=s[r],o=[];c.forEach(function(t,e){t=We(Xe(n,t),[i,u[e]]);o.push.apply(o,t.map(function(t){return{index1:r,index2:e,pos:t,type:"intersection"}}))}),o.sort(function(t,e){return C(i[0],t.pos)-C(i[0],e.pos)}),l.push.apply(l,o),je(i[1],a)&&l.push({index1:r,index2:-1,pos:i[1],type:"inside"})}),u.forEach(function(t,n){var r,e;je(t[1],i)&&(r=!1,-1===(e=mt(l,function(t){if(t.index2!==n)return!!r;r=!0}))&&(r=!1,e=mt(l,function(t){var e=t.index1,t=t.index2;if(-1!==e||t+1!==n)return!!r;r=!0})),-1===e?l.push({index1:-1,index2:n,pos:t[1],type:"inside"}):l.splice(e,0,{index1:-1,index2:n,pos:t[1],type:"inside"}))}),n={},l.filter(function(t){t=t.pos,t=t[0]+"x"+t[1];return!n[t]&&(n[t]=!0)}).map(function(t){return t.pos})}var He=function(){return(He=Object.assign||function(t){for(var e,n=1,r=arguments.length;n<r;n++)for(var i in e=arguments[n])Object.prototype.hasOwnProperty.call(e,i)&&(t[i]=e[i]);return t}).apply(this,arguments)};var Ve=function(){function t(){this._events={}}var e=t.prototype;return e.on=function(t,e){if(ot(t))for(var n in t)this.on(n,t[n]);else this._addEvent(t,e,{});return this},e.off=function(t,e){if(t)if(ot(t))for(var n in t)this.off(n);else{var r,i;e?(r=this._events[t])&&-1<(i=mt(r,function(t){return t.listener===e}))&&r.splice(i,1):this._events[t]=[]}else this._events={};return this},e.once=function(e,t){var n=this;return t&&this._addEvent(e,t,{once:!0}),new Promise(function(t){n._addEvent(e,t,{once:!0})})},e.emit=function(e,n){var r=this,t=(void 0===n&&(n={}),this._events[e]);if(!e||!t)return!0;var i=!1;return n.eventType=e,n.stop=function(){i=!0},n.currentTarget=this,function(){for(var t=0,e=0,n=arguments.length;e<n;e++)t+=arguments[e].length;for(var r=Array(t),i=0,e=0;e<n;e++)for(var o=arguments[e],a=0,s=o.length;a<s;a++,i++)r[i]=o[a];return r}(t).forEach(function(t){t.listener(n),t.once&&r.off(e,t.listener)}),!i},e.trigger=function(t,e){return this.emit(t,e=void 0===e?{}:e)},e._addEvent=function(t,e,n){var r=this._events;r[t]=r[t]||[],r[t].push(He({listener:e},n))},t}(),Ue=function(t,e){return(Ue=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(t,e){t.__proto__=e}||function(t,e){for(var n in e)e.hasOwnProperty(n)&&(t[n]=e[n])})(t,e)};var $e=function(){return($e=Object.assign||function(t){for(var e,n=1,r=arguments.length;n<r;n++)for(var i in e=arguments[n])Object.prototype.hasOwnProperty.call(e,i)&&(t[i]=e[i]);return t}).apply(this,arguments)};function Ze(t){t=t.container;return t===document.body?[t.scrollLeft||document.documentElement.scrollLeft,t.scrollTop||document.documentElement.scrollTop]:[t.scrollLeft,t.scrollTop]}function Ke(t){return t?st(t)?t():t instanceof Element?t:"current"in t?t.current:"value"in t?t.value:void 0:null}var Je=function(e){function t(){this.constructor=n}var n;function r(){var t=null!==e&&e.apply(this,arguments)||this;return t._startRect=null,t._startPos=[],t._prevTime=0,t._timer=0,t._prevScrollPos=[0,0],t._isWait=!1,t._flag=!1,t}Ue(n=r,i=e),n.prototype=null===i?Object.create(i):(t.prototype=i.prototype,new t);var i=r.prototype;return i.dragStart=function(t,e){var n,r,i,o,a=Ke(e.container);a?(o=i=r=n=0,o=a===document.body?(i=window.innerWidth,window.innerHeight):(n=(a=a.getBoundingClientRect()).top,r=a.left,i=a.width,a.height),this._flag=!0,this._startPos=[t.clientX,t.clientY],this._startRect={top:n,left:r,width:i,height:o},this._prevScrollPos=this._getScrollPosition([0,0],e)):this._flag=!1},i.drag=function(t,e){var n,r,i,o,a,s;if(this._flag)return n=t.clientX,r=t.clientY,i=e.threshold,i=void 0===i?0:i,o=this._startRect,a=this._startPos,s=[0,0],o.top>r-i?(a[1]>o.top||r<a[1])&&(s[1]=-1):o.top+o.height<r+i&&(a[1]<o.top+o.height||r>a[1])&&(s[1]=1),o.left>n-i?(a[0]>o.left||n<a[0])&&(s[0]=-1):o.left+o.width<n+i&&(a[0]<o.left+o.width||n>a[0])&&(s[0]=1),clearTimeout(this._timer),!(!s[0]&&!s[1])&&this._continueDrag($e($e({},e),{direction:s,inputEvent:t,isDrag:!0}))},i.checkScroll=function(t){var e=this;if(this._isWait)return!1;var n=t.prevScrollPos,n=void 0===n?this._prevScrollPos:n,r=t.direction,i=t.throttleTime,i=void 0===i?0:i,o=t.inputEvent,a=t.isDrag,s=this._getScrollPosition(r||[0,0],t),u=s[0]-n[0],n=s[1]-n[1],r=r||[u?Math.abs(u)/u:0,n?Math.abs(n)/n:0];return this._prevScrollPos=s,!(!u&&!n)&&(this.trigger("move",{offsetX:r[0]?u:0,offsetY:r[1]?n:0,inputEvent:o}),i&&a&&(this._timer=window.setTimeout(function(){e._continueDrag(t)},i)),!0)},i.dragEnd=function(){clearTimeout(this._timer)},i._getScrollPosition=function(t,e){var n=e.container,e=e.getScrollPosition;return(void 0===e?Ze:e)({container:Ke(n),direction:t})},i._continueDrag=function(t){var e=this,n=t.container,r=t.direction,i=t.throttleTime,o=t.useScroll,a=t.isDrag,s=t.inputEvent;if(!a||!this._isWait){var u=vt(),i=Math.max(i+this._prevTime-u,0);if(0<i)return this._timer=window.setTimeout(function(){e._continueDrag(t)},i),!1;this._prevTime=u;i=this._getScrollPosition(r,t);return this._prevScrollPos=i,a&&(this._isWait=!0),this.trigger("scroll",{container:Ke(n),direction:r,inputEvent:s}),this._isWait=!1,o||this.checkScroll($e($e({},t),{prevScrollPos:i,direction:r,inputEvent:s}))}},r}(Ve),Qe=function(t,e){return(Qe=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(t,e){t.__proto__=e}||function(t,e){for(var n in e)e.hasOwnProperty(n)&&(t[n]=e[n])})(t,e)};var E=function(){return(E=Object.assign||function(t){for(var e,n=1,r=arguments.length;n<r;n++)for(var i in e=arguments[n])Object.prototype.hasOwnProperty.call(e,i)&&(t[i]=e[i]);return t}).apply(this,arguments)};function tn(t){return 180*(e=[t[0].clientX,t[0].clientY],t=[t[1].clientX,t[1].clientY],n=t[0]-e[0],t=t[1]-e[1],(0<=(e=Math.atan2(t,n))?e:e+2*Math.PI)/Math.PI);var e,n}function en(t){if(!t)return[];if(t.touches){for(var e=t.touches,n=Math.min(e.length,2),r=[],i=0;i<n;++i)r.push(on(e[i]));return r}return[on(t)]}function nn(t,e,n){var r=n.length,t=an(t,r),i=t.clientX,o=t.clientY,a=t.originalClientX,t=t.originalClientY,e=an(e,r),s=e.clientX,e=e.clientY,n=an(n,r);return{clientX:a,clientY:t,deltaX:i-s,deltaY:o-e,distX:i-n.clientX,distY:o-n.clientY}}function rn(t){return Math.sqrt(Math.pow(t[0].clientX-t[1].clientX,2)+Math.pow(t[0].clientY-t[1].clientY,2))}function on(t){return{clientX:t.clientX,clientY:t.clientY}}function an(t,e){void 0===e&&(e=t.length);for(var n={clientX:0,clientY:0,originalClientX:0,originalClientY:0},r=0;r<e;++r){var i=t[r];n.originalClientX+="originalClientX"in i?i.originalClientX:i.clientX,n.originalClientY+="originalClientY"in i?i.originalClientY:i.clientY,n.clientX+=i.clientX,n.clientY+=i.clientY}return e?{clientX:n.clientX/e,clientY:n.clientY/e,originalClientX:n.originalClientX/e,originalClientY:n.originalClientY/e}:n}var sn=function(){function t(t){this.prevClients=[],this.startClients=[],this.movement=0,this.length=0,this.startClients=t,this.prevClients=t,this.length=t.length}var e=t.prototype;return e.getAngle=function(t){return tn(t=void 0===t?this.prevClients:t)},e.getRotation=function(t){return tn(t=void 0===t?this.prevClients:t)-tn(this.startClients)},e.getPosition=function(t,e){var n=nn((t=void 0===t?this.prevClients:t)||this.prevClients,this.prevClients,this.startClients),r=n.deltaX,i=n.deltaY;return this.movement+=Math.sqrt(r*r+i*i),this.prevClients=t,n},e.getPositions=function(n){void 0===n&&(n=this.prevClients);var r=this.prevClients;return this.startClients.map(function(t,e){return nn([n[e]],[r[e]],[t])})},e.getMovement=function(t){var e=this.movement;if(!t)return e;var t=an(t,this.length),n=an(this.prevClients,this.length),r=t.clientX-n.clientX,t=t.clientY-n.clientY;return Math.sqrt(r*r+t*t)+e},e.getDistance=function(t){return rn(t=void 0===t?this.prevClients:t)},e.getScale=function(t){return rn(t=void 0===t?this.prevClients:t)/rn(this.startClients)},e.move=function(e,n){this.startClients.forEach(function(t){t.clientX-=e,t.clientY-=n})},t}(),un=["textarea","input"],cn=function(o){function t(){this.constructor=e}var e;function n(t,e){void 0===e&&(e={});var n,g=o.call(this)||this,t=(g.options={},g.flag=!1,g.pinchFlag=!1,g.data={},g.isDrag=!1,g.isPinch=!1,g.isMouse=!1,g.isTouch=!1,g.clientStores=[],g.targets=[],g.prevTime=0,g.doubleFlag=!1,g._dragFlag=!1,g._isMouseEvent=!1,g._isSecondaryButton=!1,g._preventMouseEvent=!1,g.onDragStart=function(t,e){if(void 0===e&&(e=!0),g.flag||!1!==t.cancelable){var n=g.options,r=n.container,i=n.pinchOutside,o=n.preventWheelClick,a=n.preventRightClick,s=n.preventDefault,u=n.checkInput,c=n.preventClickEventOnDragStart,l=n.preventClickEventOnDrag,n=n.preventClickEventByCondition,f=g.isTouch,p=!g.flag;if(g._isSecondaryButton=3===t.which||2===t.button,o&&(2===t.which||1===t.button)||a&&(3===t.which||2===t.button))return g.stop(),!1;if(p){o=document.activeElement,a=t.target;if(a){var d=a.tagName.toLowerCase(),d=-1<un.indexOf(d),h=a.isContentEditable;if(d||h){if(u||o===a)return!1;if(o&&h&&o.isContentEditable&&o.contains(a))return!1}else(s||"touchstart"===t.type)&&o&&(d=o.tagName,(o.isContentEditable||-1<un.indexOf(d))&&o.blur());(c||l||n)&&v(window,"click",g._onClick,!0)}g.clientStores=[new sn(en(t))],g.flag=!0,g.isDrag=!1,g._dragFlag=!0,g.data={},g.doubleFlag=vt()-g.prevTime<200,g._isMouseEvent=(u=t)&&(-1<u.type.indexOf("mouse")||"button"in u),!g._isMouseEvent&&g._preventMouseEvent&&(g._preventMouseEvent=!1),!1===(g._preventMouseEvent||g.emit("dragStart",E(E({data:g.data,datas:g.data,inputEvent:t,isMouseEvent:g._isMouseEvent,isSecondaryButton:g._isSecondaryButton,isTrusted:e,isDouble:g.doubleFlag},g.getCurrentStore().getPosition()),{preventDefault:function(){t.preventDefault()},preventDrag:function(){g._dragFlag=!1}})))&&g.stop(),g._isMouseEvent&&g.flag&&s&&t.preventDefault()}if(!g.flag)return!1;h=0;p?(g._attchDragEvent(),f&&i&&(h=setTimeout(function(){v(r,"touchstart",g.onDragStart,{passive:!1})}))):f&&i&&m(r,"touchstart",g.onDragStart),g.flag&&((a=t).touches&&2<=a.touches.length)&&(clearTimeout(h),p&&t.touches.length!==t.changedTouches.length||g.pinchFlag||g.onPinchStart(t))}},g.onDrag=function(t,e){if(g.flag){var n=g.options.preventDefault,n=(!g._isMouseEvent&&n&&t.preventDefault(),en(t)),r=g.moveClients(n,t,!1);if(g._dragFlag){if(g.pinchFlag||r.deltaX||r.deltaY)if(!1===(g._preventMouseEvent||g.emit("drag",E(E({},r),{isScroll:!!e,inputEvent:t}))))return void g.stop();g.pinchFlag&&g.onPinch(t,n)}g.getCurrentStore().getPosition(n,!0)}},g.onDragEnd=function(t){var e,n,r,i,o,a;g.flag&&(a=(r=g.options).pinchOutside,e=r.container,o=r.preventClickEventOnDrag,i=r.preventClickEventOnDragStart,r=r.preventClickEventByCondition,n=g.isDrag,(o||i||r)&&requestAnimationFrame(function(){g._allowClickEvent()}),r||i||!o||n||g._allowClickEvent(),g.isTouch&&a&&m(e,"touchstart",g.onDragStart),g.pinchFlag&&g.onPinchEnd(t),0!==(r=null!=t&&t.touches?en(t):[]).length&&g.options.keepDragging?g._addStore(new sn(r)):g.flag=!1,i=g._getPosition(),o=vt(),a=!n&&g.doubleFlag,g.prevTime=n||a?0:o,g.flag||(g._dettachDragEvent(),g._preventMouseEvent||g.emit("dragEnd",E({data:g.data,datas:g.data,isDouble:a,isDrag:n,isClick:!n,isMouseEvent:g._isMouseEvent,isSecondaryButton:g._isSecondaryButton,inputEvent:t},i)),g.clientStores=[],g._isMouseEvent||(g._preventMouseEvent=!0,requestAnimationFrame(function(){requestAnimationFrame(function(){g._preventMouseEvent=!1})}))))},g.onBlur=function(){g.onDragEnd()},g._allowClickEvent=function(){m(window,"click",g._onClick,!0)},g._onClick=function(t){g._preventMouseEvent=!1;var e=g.options.preventClickEventByCondition;null!=e&&e(t)||(t.stopPropagation(),t.preventDefault())},g._onContextMenu=function(t){g.options.preventRightClick?g.onDragEnd(t):t.preventDefault()},g._passCallback=function(){},[].concat(t)),e=(g.options=E({checkInput:!1,container:1<t.length?window:t[0],preventRightClick:!0,preventWheelClick:!0,preventClickEventOnDragStart:!1,preventClickEventOnDrag:!1,preventClickEventByCondition:null,preventDefault:!0,checkWindowBlur:!1,keepDragging:!1,pinchThreshold:0,events:["touch","mouse"]},e),g.options),r=e.container,i=e.events,e=e.checkWindowBlur;return g.isTouch=-1<i.indexOf("touch"),g.isMouse=-1<i.indexOf("mouse"),g.targets=t,g.isMouse&&(t.forEach(function(t){v(t,"mousedown",g.onDragStart),v(t,"mousemove",g._passCallback)}),v(r,"contextmenu",g._onContextMenu)),e&&v(window,"blur",g.onBlur),g.isTouch&&(n={passive:!1},t.forEach(function(t){v(t,"touchstart",g.onDragStart,n),v(t,"touchmove",g._passCallback,n)})),g}Qe(e=n,r=o),e.prototype=null===r?Object.create(r):(t.prototype=r.prototype,new t);var r=n.prototype;return r.stop=function(){this.isDrag=!1,this.data={},this.clientStores=[],this.pinchFlag=!1,this.doubleFlag=!1,this.prevTime=0,this.flag=!1,this._allowClickEvent(),this._dettachDragEvent()},r.getMovement=function(t){return this.getCurrentStore().getMovement(t)+this.clientStores.slice(1).reduce(function(t,e){return t+e.movement},0)},r.isDragging=function(){return this.isDrag},r.isFlag=function(){return this.flag},r.isPinchFlag=function(){return this.pinchFlag},r.isDoubleFlag=function(){return this.doubleFlag},r.isPinching=function(){return this.isPinch},r.scrollBy=function(t,e,n,r){void 0===r&&(r=!0),this.flag&&(this.clientStores[0].move(t,e),r&&this.onDrag(n,!0))},r.move=function(t,e){var n=t[0],r=t[1],t=this.getCurrentStore().prevClients;return this.moveClients(t.map(function(t){var e=t.clientX,t=t.clientY;return{clientX:e+n,clientY:t+r,originalClientX:e,originalClientY:t}}),e,!0)},r.triggerDragStart=function(t){this.onDragStart(t,!1)},r.setEventData=function(t){var e,n=this.data;for(e in t)n[e]=t[e];return this},r.setEventDatas=function(t){return this.setEventData(t)},r.getCurrentEvent=function(t){return E(E({data:this.data,datas:this.data},this._getPosition()),{movement:this.getMovement(),isDrag:this.isDrag,isPinch:this.isPinch,isScroll:!1,inputEvent:t})},r.getEventData=function(){return this.data},r.getEventDatas=function(){return this.data},r.unset=function(){var e=this,t=this.targets,n=this.options.container;this.off(),m(window,"blur",this.onBlur),this.isMouse&&(t.forEach(function(t){m(t,"mousedown",e.onDragStart)}),m(n,"contextmenu",this._onContextMenu)),this.isTouch&&(t.forEach(function(t){m(t,"touchstart",e.onDragStart)}),m(n,"touchstart",this.onDragStart)),this._dettachDragEvent()},r.onPinchStart=function(t){var e=this.options.pinchThreshold;this.isDrag&&this.getMovement()>e||(e=new sn(en(t)),this.pinchFlag=!0,this._addStore(e),!1===this.emit("pinchStart",E(E({data:this.data,datas:this.data,angle:e.getAngle(),touches:this.getCurrentStore().getPositions()},e.getPosition()),{inputEvent:t}))&&(this.pinchFlag=!1))},r.onPinch=function(t,e){var n;!this.flag||!this.pinchFlag||e.length<2||(n=this.getCurrentStore(),this.isPinch=!0,this.emit("pinch",E(E({data:this.data,datas:this.data,movement:this.getMovement(e),angle:n.getAngle(e),rotation:n.getRotation(e),touches:n.getPositions(e),scale:n.getScale(e),distance:n.getDistance(e)},n.getPosition(e)),{inputEvent:t})))},r.onPinchEnd=function(t){var e,n;this.pinchFlag&&(e=this.isPinch,this.isPinch=!1,this.pinchFlag=!1,n=this.getCurrentStore(),this.emit("pinchEnd",E(E({data:this.data,datas:this.data,isPinch:e,touches:n.getPositions()},n.getPosition()),{inputEvent:t})))},r.getCurrentStore=function(){return this.clientStores[0]},r.moveClients=function(t,e,n){n=this._getPosition(t,n);return(n.deltaX||n.deltaY)&&(this.isDrag=!0),E(E({data:this.data,datas:this.data},n),{movement:this.getMovement(t),isDrag:this.isDrag,isPinch:this.isPinch,isScroll:!1,isMouseEvent:this._isMouseEvent,isSecondaryButton:this._isSecondaryButton,inputEvent:e})},r._addStore=function(t){this.clientStores.splice(0,0,t)},r._getPosition=function(t,e){var t=this.getCurrentStore().getPosition(t,e),e=this.clientStores.slice(1).reduce(function(t,e){e=e.getPosition();return t.distX+=e.distX,t.distY+=e.distY,t},t),n=e.distX,e=e.distY;return E(E({},t),{distX:n,distY:e})},r._attchDragEvent=function(){var t=this.options.container,e={passive:!1};this.isMouse&&(v(t,"mousemove",this.onDrag),v(t,"mouseup",this.onDragEnd)),this.isTouch&&(v(t,"touchmove",this.onDrag,e),v(t,"touchend",this.onDragEnd,e),v(t,"touchcancel",this.onDragEnd,e))},r._dettachDragEvent=function(){var t=this.options.container;this.isMouse&&(m(t,"mousemove",this.onDrag),m(t,"mouseup",this.onDragEnd)),this.isTouch&&(m(t,"touchstart",this.onDragStart),m(t,"touchmove",this.onDrag),m(t,"touchend",this.onDragEnd),m(t,"touchcancel",this.onDragEnd))},n}(Ve);var ln=function(t){for(var e=5381,n=t.length;n;)e=33*e^t.charCodeAt(--n);return e>>>0};function fn(t,e,n,r){var i,o=document.createElement("style");return o.setAttribute("type","text/css"),o.setAttribute("data-styled-id",t),n.nonce&&o.setAttribute("nonce",n.nonce),o.innerHTML=(i=t,t=e,n.original?t:t.replace(/([^};{\s}][^};{]*|^\s*){/gm,function(t,e){e=e.trim();return(e?pt(e):[""]).map(function(t){t=t.trim();return 0===t.indexOf("@")?t:-1<t.indexOf(":global")?t.replace(/\:global/g,""):-1<t.indexOf(":host")?""+t.replace(/\:host/g,"."+i):t?"."+i+" "+t:"."+i}).join(", ")+" {"})),(r||document.head||document.body).appendChild(o),o}function pn(i){var o,a="rCS"+ln(i).toString(36),s=0;return{className:a,inject:function(t,e){void 0===e&&(e={});var n,r=function(t){if(t&&t.getRootNode){t=t.getRootNode();if(11===t.nodeType)return t}}(t),t=0===s;return(r||t)&&(n=fn(a,i,e,r)),t&&(o=n),r||++s,{destroy:function(){r?(r.removeChild(n),n=null):(0<s&&--s,0===s&&o&&(o.parentNode.removeChild(o),o=null))}}}}}var dn=function(t,e){return(dn=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(t,e){t.__proto__=e}||function(t,e){for(var n in e)e.hasOwnProperty(n)&&(t[n]=e[n])})(t,e)};function hn(t,e){function n(){this.constructor=t}dn(t,e),t.prototype=null===e?Object.create(e):(n.prototype=e.prototype,new n)}var gn=function(){return(gn=Object.assign||function(t){for(var e,n=1,r=arguments.length;n<r;n++)for(var i in e=arguments[n])Object.prototype.hasOwnProperty.call(e,i)&&(t[i]=e[i]);return t}).apply(this,arguments)};var vn=function(e){function t(){var t=null!==e&&e.apply(this,arguments)||this;return t.injectResult=null,t.tag="div",t}hn(t,e);var n=t.prototype;return n.render=function(){var t=this.props,e=t.className,e=void 0===e?"":e,n=(t.cspNonce,t.portalContainer),t=function(t,e){var n={};for(i in t)Object.prototype.hasOwnProperty.call(t,i)&&e.indexOf(i)<0&&(n[i]=t[i]);if(null!=t&&"function"==typeof Object.getOwnPropertySymbols)for(var r=0,i=Object.getOwnPropertySymbols(t);r<i.length;r++)e.indexOf(i[r])<0&&Object.prototype.propertyIsEnumerable.call(t,i[r])&&(n[i[r]]=t[i[r]]);return n}(t,["className","cspNonce","portalContainer"]),r=this.injector.className,i=this.tag,o={};return-1<"simple-1.1.0".indexOf("simple")&&n&&(o={portalContainer:n}),x(i,gn({ref:S(this,"element"),"data-styled-id":r,className:e+" "+r},o,t))},n.componentDidMount=function(){this.injectResult=this.injector.inject(this.element,{nonce:this.props.cspNonce})},n.componentWillUnmount=function(){this.injectResult.destroy(),this.injectResult=null},n.getElement=function(){return this.element},t}(It);function mn(n,t){var r=pn(t);return function(e){function t(){var t=null!==e&&e.apply(this,arguments)||this;return t.injector=r,t.tag=n,t}return hn(t,e),t}(vn)}var bn=function(t,e){return(bn=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(t,e){t.__proto__=e}||function(t,e){for(var n in e)Object.prototype.hasOwnProperty.call(e,n)&&(t[n]=e[n])})(t,e)};function xn(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Class extends value "+String(e)+" is not a constructor or null");function n(){this.constructor=t}bn(t,e),t.prototype=null===e?Object.create(e):(n.prototype=e.prototype,new n)}var A=function(){return(A=Object.assign||function(t){for(var e,n=1,r=arguments.length;n<r;n++)for(var i in e=arguments[n])Object.prototype.hasOwnProperty.call(e,i)&&(t[i]=e[i]);return t}).apply(this,arguments)};function Q(t,e,n){if(n||2===arguments.length)for(var r,i=0,o=e.length;i<o;i++)!r&&i in e||((r=r||Array.prototype.slice.call(e,0,i))[i]=e[i]);return t.concat(r||Array.prototype.slice.call(e))}function En(t,e){var n;return A({events:{},props:((n={})[t]=Boolean,n),name:t},e)}var yn,e,Sn,n,Mn,r,i,le=void 0===bo&&function(){var t;if("undefined"!=typeof navigator&&navigator&&navigator.userAgentData)return(t=(t=navigator.userAgentData).brands||t.uaList)&&t.length}()?(yn=((r=navigator.userAgentData).uaList||r.brands).slice(),e=o&&o.fullVersionList,Sn=r.mobile||!1,n=yn[0],Mn=(o&&o.platform||r.platform||navigator.platform).toLowerCase(),r={name:n.brand,version:n.version,majorVersion:-1,webkit:!1,webkitVersion:"-1",chromium:!1,chromiumVersion:"-1",webview:!!oe(ce,yn).brand||fe(ee())},n={name:"unknown",version:"-1",majorVersion:-1},r.webkit=!r.chromium&&Qt(ue,function(t){return ae(yn,t)}),i=oe(se,yn),r.chromium=!!i.brand,r.chromiumVersion=i.version,r.chromium||(i=oe(ue,yn),r.webkit=!!i.brand,r.webkitVersion=i.version),i=te(le,function(t){return new RegExp(""+t.test,"g").exec(Mn)}),n.name=i?i.id:"",o&&(n.version=o.platformVersion),e&&e.length?(i=oe(t,e),r.name=i.brand||r.name,r.version=i.version||r.version):(e=oe(t,yn),r.name=e.brand||r.name,r.version=e.brand&&o?o.uaFullVersion:e.version),r.webkit&&(n.name=Sn?"ios":"mac"),"ios"===n.name&&r.webview&&(r.version="-1"),n.version=re(n.version),r.version=re(r.version),n.majorVersion=parseInt(n.version,10),r.majorVersion=parseInt(r.version,10),{browser:r,os:n,isMobile:Sn,isHints:!0}):(i=ee(i=bo),o=!!/mobi/g.exec(i),e={name:"unknown",version:"-1",majorVersion:-1,webview:fe(i),chromium:!1,chromiumVersion:"-1",webkit:!1,webkitVersion:"-1"},r={name:"unknown",version:"-1",majorVersion:-1},Sn=(n=ie(t,i)).preset,n=n.version,d=(bo=ie(le,i)).preset,bo=bo.version,t=ie(se,i),e.chromium=!!t.preset,e.chromiumVersion=t.version,e.chromium||(t=ie(ue,i),e.webkit=!!t.preset,e.webkitVersion=t.version),d&&(r.name=d.id,r.version=bo,r.majorVersion=parseInt(bo,10)),Sn&&(e.name=Sn.id,e.version=n,e.webview&&"ios"===r.name&&"safari"!==e.name&&(e.webview=!1)),e.majorVersion=parseInt(e.version,10),{browser:e,os:r,isMobile:o,isHints:!1}),Cn=le.browser.webkit,wn=Cn&&(se="undefined"==typeof window?{userAgent:""}:window.navigator,!!(se=/applewebkit\/([^\s]+)/g.exec(se.userAgent.toLowerCase()))&&parseFloat(se[1])<605),Dn="firefox"===le.browser.name,Rn=612<=parseInt(le.browser.webkitVersion,10)||15<=parseInt(le.browser.version,10),On="moveable-",_n="\n{\n\tposition: absolute;\n\twidth: 1px;\n\theight: 1px;\n\tleft: 0;\n\ttop: 0;\n    z-index: 3000;\n    --moveable-color: #4af;\n    --zoom: 1;\n    --zoompx: 1px;\n    will-change: transform;\n}\n.control-box {\n    z-index: 0;\n}\n.line, .control {\n    position: absolute;\n\tleft: 0;\n    top: 0;\n    will-change: transform;\n}\n.control {\n\twidth: 14px;\n\theight: 14px;\n\tborder-radius: 50%;\n\tborder: 2px solid #fff;\n\tbox-sizing: border-box;\n    background: #4af;\n    background: var(--moveable-color);\n\tmargin-top: -7px;\n    margin-left: -7px;\n    border: 2px solid #fff;\n    z-index: 10;\n}\n.padding {\n    position: absolute;\n    top: 0px;\n    left: 0px;\n    width: 100px;\n    height: 100px;\n    transform-origin: 0 0;\n}\n.line {\n\twidth: 1px;\n    height: 1px;\n    background: #4af;\n    background: var(--moveable-color);\n\ttransform-origin: 0px 50%;\n}\n.line.edge {\n    z-index: 1;\n    background: transparent;\n}\n.line.dashed {\n    box-sizing: border-box;\n    background: transparent;\n}\n.line.dashed.horizontal {\n    border-top: 1px dashed #4af;\n    border-top-color: #4af;\n    border-top-color: var(--moveable-color);\n}\n.line.dashed.vertical {\n    border-left: 1px dashed #4af;\n    border-left-color: #4af;\n    border-left-color: var(--moveable-color);\n}\n.line.vertical {\n    transform: translateX(-50%);\n}\n.line.horizontal {\n    transform: translateY(-50%);\n}\n.line.vertical.bold {\n    width: 2px;\n}\n.line.horizontal.bold {\n    height: 2px;\n}\n\n.control.origin {\n\tborder-color: #f55;\n\tbackground: #fff;\n\twidth: 12px;\n\theight: 12px;\n\tmargin-top: -6px;\n    margin-left: -6px;\n\tpointer-events: none;\n}\n".concat([0,15,30,45,60,75,90,105,120,135,150,165].map(function(t){return'\n.direction[data-rotation="'.concat(t,'"] {\n\t').concat((n=t=t,e='data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="'.concat(32*(e=1),'px" height="').concat(32*e,'px" viewBox="0 0 32 32" ><path d="M 16,5 L 12,10 L 14.5,10 L 14.5,22 L 12,22 L 16,27 L 20,22 L 17.5,22 L 17.5,10 L 20, 10 L 16,5 Z" stroke-linejoin="round" stroke-width="1.2" fill="black" stroke="white" style="transform:rotate(').concat(n,'deg);transform-origin: 16px 16px"></path></svg>'),n=45*Math.round(t/45)%180,t="ns-resize",135==n?t="nwse-resize":45==n?t="nesw-resize":90==n&&(t="ew-resize"),"cursor:".concat(t,";cursor: url('").concat(e,"') 16 16, ").concat(t,";")),"\n}\n");var e,n}).join("\n"),"\n.group {\n    z-index: -1;\n}\n.area {\n    position: absolute;\n}\n.area-pieces {\n    position: absolute;\n    top: 0;\n    left: 0;\n    display: none;\n}\n.area.avoid, .area.pass {\n    pointer-events: none;\n}\n.area.avoid+.area-pieces {\n    display: block;\n}\n.area-piece {\n    position: absolute;\n}\n\n").concat(wn?':global svg *:before {\n\tcontent:"";\n\ttransform-origin: inherit;\n}':"","\n"),Pn=[[0,1,2],[1,0,3],[2,0,3],[3,1,2]],Bn=1e-4,F=1e-7,zn=Math.pow(10,10),Tn=-zn,Gn=["n","w","s","e"],kn=["n","w","s","e","nw","ne","sw","se"],An={n:[0,-1],e:[1,0],s:[0,1],w:[-1,0],nw:[-1,-1],ne:[1,-1],sw:[-1,1],se:[1,1]},Fn={n:[0,1],e:[1,3],s:[3,2],w:[2,0],nw:[0],ne:[1],sw:[2],se:[3]},In={n:0,s:180,w:270,e:90,nw:315,ne:45,sw:225,se:135},Nn=["isMoveableElement","updateRect","updateTarget","destroy","dragStart","isInside","hitTest","setState","getRect","request","isDragging","getManager","forceUpdate","waitToChangeTarget","updateSelectors"];function jn(t,e,n,r,i,o){var n=e.gestos[o=void 0===o?"draggable":o].move(n,t.inputEvent),a=n.originalDatas||n.datas,a=a[o]||(a[o]={});return A(A({},i?Hr(e,n):n),{isPinch:!!r,parentEvent:!0,datas:a,originalDatas:t.originalDatas})}var Yn=function(){function t(t){var e;this.ableName=t=void 0===t?"draggable":t,this.prevX=0,this.prevY=0,this.startX=0,this.startY=0,this.isDrag=!1,this.isFlag=!1,this.datas={draggable:{}},this.datas=((e={})[t]={},e)}var e=t.prototype;return e.dragStart=function(t,e){this.isDrag=!1,this.isFlag=!1;var n=e.originalDatas;return(this.datas=n)[this.ableName]||(n[this.ableName]={}),A(A({},this.move(t,e.inputEvent)),{type:"dragstart"})},e.drag=function(t,e){return this.move([t[0]-this.prevX,t[1]-this.prevY],e)},e.move=function(t,e){var n,r;return this.isFlag?(n=this.prevX+t[0],r=this.prevY+t[1],(t[0]||t[1])&&(this.isDrag=!0)):(this.prevX=t[0],this.prevY=t[1],this.startX=t[0],this.startY=t[1],n=t[0],r=t[1],this.isFlag=!0),{type:"drag",clientX:this.prevX=n,clientY:this.prevY=r,inputEvent:e,isDrag:this.isDrag,distX:n-this.startX,distY:r-this.startY,deltaX:t[0],deltaY:t[1],datas:this.datas[this.ableName],originalDatas:this.datas,parentEvent:!0,parentGesto:this}},t}();function Xn(t,e){var n=e.clientX,r=e.clientY,e=e.datas,t=t.state,i=t.moveableClientRect,o=t.rootMatrix,a=t.is3d,t=t.pos1,o=T(Lr(o,[n-i.left,r-i.top],a?4:3),t),n=$n({datas:e,distX:o[0],distY:o[1]});return[n[0],n[1]]}function Wn(t,e){var e=e.datas,t=t.state,n=t.allMatrix,r=t.beforeMatrix,i=t.is3d,o=t.left,a=t.top,s=t.origin,u=t.offsetMatrix,c=t.targetMatrix,t=t.transformOrigin,l=i?4:3;e.is3d=i,e.matrix=n,e.targetMatrix=c,e.beforeMatrix=r,e.offsetMatrix=u,e.transformOrigin=t,e.inverseMatrix=de(n,l),e.inverseBeforeMatrix=de(r,l),e.absoluteOrigin=ge(J([o,a],s),l),e.startDragBeforeDist=B(e.inverseBeforeMatrix,e.absoluteOrigin,l),e.startDragDist=B(e.inverseMatrix,e.absoluteOrigin,l)}function qn(t,e){var n,r,i,o,a,s,u,c,l,f,p,d,h,g=t.datas,t=t.originalDatas.beforeRenderable,v=g.transformIndex,m=t.nextTransforms,b=m.length,x=t.nextTransformAppendedIndexes,E=0,m=(-1===v?(E=m.length,g.transformIndex=E):E=bt(x,function(t){return t.index===v&&t.functionName===e})?v:v+x.filter(function(t){return t.index<v}).length,n=E,r=(m=m).slice(0,n<0?void 0:n),i=m.slice(0,n<0?void 0:n+1),o=m[n]||"",a=n<0?[]:m.slice(n),n=n<0?[]:m.slice(n+1),s=ze(r),u=ze(i),c=ze([o]),l=ze(a),f=ze(n),y=Be(s),S=Be(u),p=Be(l),d=Be(f),h=K(y,p,4),{transforms:m,beforeFunctionMatrix:y,beforeFunctionMatrix2:S,targetFunctionMatrix:Be(c),afterFunctionMatrix:p,afterFunctionMatrix2:d,allFunctionMatrix:h,beforeFunctions:s,beforeFunctions2:u,targetFunction:c[0],afterFunctions:l,afterFunctions2:f,beforeFunctionTexts:r,beforeFunctionTexts2:i,targetFunctionText:o,afterFunctionTexts:a,afterFunctionTexts2:n}),y=m.targetFunction,S="rotate"===e?"rotateZ":e;g.beforeFunctionTexts=m.beforeFunctionTexts,g.afterFunctionTexts=m.afterFunctionTexts,g.beforeTransform=m.beforeFunctionMatrix,g.beforeTransform2=m.beforeFunctionMatrix2,g.targetTansform=m.targetFunctionMatrix,g.afterTransform=m.afterFunctionMatrix,g.afterTransform2=m.afterFunctionMatrix2,g.targetAllTransform=m.allFunctionMatrix,y.functionName===S?(g.afterFunctionTexts.splice(0,1),g.isAppendTransform=!1):E<b&&(g.isAppendTransform=!0,t.nextTransformAppendedIndexes=Q(Q([],x,!0),[{functionName:e,index:E,isAppend:!0}],!1))}function Ln(t,e,n){return"".concat(t.beforeFunctionTexts.join(" ")," ").concat(t.isAppendTransform?n:e," ").concat(t.afterFunctionTexts.join(" "))}function Hn(t){var e=t.datas,t=Un({datas:e,distX:t.distX,distY:t.distY});return B(Vn(e,function(t,e){for(var n=Y(e),r=0;r<e-1;++r)n[e*(e-1)+r]=t[r]||0;return n}([t[0],t[1]],4)),ge([0,0,0],4),4)}function Vn(t,e,n){var r=t.beforeTransform,i=t.afterTransform,o=t.beforeTransform2,a=t.afterTransform2,t=t.targetAllTransform,e=n?K(t,e,4):K(e,t,4),t=K(de(n?o:r,4),e,4);return K(t,de(n?a:i,4),4)}function Un(t){var e=t.datas,n=t.distX,t=t.distY,r=e.inverseBeforeMatrix,i=e.is3d,o=e.startDragBeforeDist,i=i?4:3;return T(B(r,J(e.absoluteOrigin,[n,t]),i),o)}function $n(t,e){var n=t.datas,r=t.distX,t=t.distY,i=n.inverseBeforeMatrix,o=n.inverseMatrix,a=n.is3d,s=n.startDragBeforeDist,u=n.startDragDist,a=a?4:3;return T(B(e?i:o,J(n.absoluteOrigin,[r,t]),a),e?s:u)}function Zn(t){var e=[];return 0<=t[1]&&(0<=t[0]&&e.push(3),t[0]<=0&&e.push(2)),t[1]<=0&&(0<=t[0]&&e.push(1),t[0]<=0&&e.push(0)),e}function j(t,e){var n=(e[0]+1)/2,e=(e[1]+1)/2,r=[rt(t[0][0],t[1][0],n,1-n),rt(t[0][1],t[1][1],n,1-n)],t=[rt(t[2][0],t[3][0],n,1-n),rt(t[2][1],t[3][1],n,1-n)];return[rt(r[0],t[0],e,1-e),rt(r[1],t[1],e,1-e)]}function Kn(t,e,n,r){return K(t,pr(e,r,n),r)}function Jn(n){var r=nr(n);return{setTransform:function(t,e){void 0===e&&(e=-1),r.startTransforms=D(t)?t:ft(t),tr(n,e)},setTransformIndex:function(t){tr(n,t)}}}function Qn(t,e){tr(t,mt(nr(t).startTransforms,function(t){return 0===t.indexOf("".concat(e,"("))}))}function tr(t,e){var n=nr(t),t=t.datas;-1!==(t.transformIndex=e)&&(n=n.startTransforms[e])&&(e=ze([n]),t.startValue=e[0].functionValue)}function er(t,e){nr(t).nextTransforms=ft(e)}function nr(t){return t.originalDatas.beforeRenderable}function rr(t){return t.originalDatas.beforeRenderable.nextTransforms}function ir(t){return rr(t).join(" ")}function or(t){return nr(t).nextStyle}function ar(t,e,n,r,i){er(i,e);t=q.drag(t,jn(i,t.state,n,r,!1)),n=t?t.transform:e;return A(A({transform:e,drag:t},Fr({transform:n},i)),{afterTransform:n})}function sr(t,e,n,r,i){var o=t.state,a=o.left,o=o.top,s=t.props.groupable;u=t.state,c=i,l=u.transformOrigin,f=u.offsetMatrix,u=u.is3d,p=i.beforeTransform,c=i.afterTransform,u=u?4:3;var u,c,l,f,p,i=s?a:0,a=s?o:0,s=T(r,ur(t,n,Kn(f,ve(K(K(p,Pe([e]),4),c,4),4,u),l,u)));return T(s,[i,a])}function ur(t,e,n){void 0===n&&(n=t.state.allMatrix);var t=t.state,r=t.width,i=t.height,t=t.is3d;return X(n,[r/2*(1+e[0]),i/2*(1+e[1])],t?4:3)}function cr(t,e,n,r,i,o){var a=t.props.groupable,t=t.state,s=t.transformOrigin,u=t.offsetMatrix,c=t.is3d,l=t.width,f=t.height,p=t.left,d=t.top,h=o.fixedDirection,o=o.nextTargetMatrix||t.targetMatrix,t=c?4:3;g=e,v=n,void 0===(m=l)&&(m=g),void 0===(b=f)&&(b=v),void 0===(x=s)&&(x=[0,0]);var g,v,m,b,x,c=a?p:0,l=a?d:0,s=Kn(u,o,(f=i)?f.map(function(t,e){var n=ht(t),r=n.value,n=n.unit,i=e?b:m,o=e?v:g;return"%"===t||isNaN(r)?o*(i?x[e]/i:0):"%"!==n?r:o*r/100}):x,t);return p=r,a=h,d=j(Sr(d=s,e,n,t),a),T([p[0]-d[0],p[1]-d[1]],[c,l])}function lr(t,e){return j(W(t.state),e)}function G(){for(var t=[],e=0;e<arguments.length;e++)t[e]=arguments[e];return function(e){for(var t=[],n=1;n<arguments.length;n++)t[n-1]=arguments[n];return t.map(function(t){return t.split(" ").map(function(t){return t?""+e+t:""}).join(" ")}).join(" ")}.apply(void 0,Q([On],t,!1))}function fr(t){t()}function pr(t,e,n){return me(e,Oe(n,e),t,Oe(n.map(function(t){return-t}),e))}function dr(r){return hr(jr(r,":before")).map(function(t,e){var t=ht(t),n=t.value,t=t.unit;return n*(n=r,e=0===e,"%"===t?yr(n.ownerSVGElement)[e?"width":"height"]/100:1)})}function hr(t){t=t.transformOrigin;return t?t.split(" "):["0","0"]}function gr(t,e){var n=(e=void 0===e?jr(t):e).transform;if(n&&"none"!==n)return e.transform;if("transform"in t){var r=t.transform.baseVal;if(!r)return"";var i=r.length;if(!i)return"";for(var o=[],a=0;a<i;++a)!function(t){var e=r[t].matrix;o.push("matrix(".concat(["a","b","c","d","e","f"].map(function(t){return e[t]}).join(", "),")"))}(a);return o.join(" ")}return""}function vr(t,e,n){for(var r,i,o,a=document.body,s=!1,u=(o=!t||n?t:(n=null==(n=null==t?void 0:t.assignedSlot)?void 0:n.parentElement,i=t.parentElement,n?(s=!0,r=i,n):i),!1),c=t===e||o===e,l="relative";o&&o!==a;){e===o&&(c=!0);var f=jr(o),p=o.tagName.toLowerCase(),d=gr(o,f),h=f.willChange,l=f.position;if("svg"===p||"static"!==l||d&&"none"!==d||"transform"===h)break;p=null==(f=null==t?void 0:t.assignedSlot)?void 0:f.parentNode,d=o.parentNode,h=(p&&(s=!0,r=d),p||d);if(h&&11===h.nodeType){o=h.host,u=!0;break}o=h,l="relative"}return{hasSlot:s,parentSlotElement:r,isCustomElement:u,isStatic:"static"===l,isEnd:c||!o||o===a,offsetParent:o||a}}function mr(t,e,n){var r,i,o=t.tagName.toLowerCase(),a=t.offsetLeft,s=t.offsetTop,u=it(a),c=!u;return c||"svg"===o?i=(r=hr(n).map(function(t){return parseFloat(t)})).slice():(i=(r=wn?dr(t):hr(n).map(function(t){return parseFloat(t)})).slice(),c=!0,a=(n=function(t,e,n){if(!t.getBBox||!n&&"g"===t.tagName.toLowerCase())return[0,0,0,0];var n=t.getBBox(),t=yr(t.ownerSVGElement),r=n.x-t.x,n=n.y-t.y;return[r,n,e[0]-r,e[1]-n]}(t,r,t===e&&"g"===e.tagName.toLowerCase()))[0],s=n[1],r[0]=n[2],r[1]=n[3]),{tagName:o,isSVG:u,hasOffset:c,offset:[a||0,s||0],origin:r,targetOrigin:i}}function br(t,e,n){void 0===n&&(n=jr(t));var t=jr(document.body),r=t.position;if(!(e||r&&"static"!==r))return[0,0];e=parseInt(t.marginLeft,10),r=parseInt(t.marginTop,10);return"absolute"===n.position&&("auto"===n.top&&"auto"===n.bottom||(r=0),"auto"===n.left&&"auto"===n.right||(e=0)),[e,r]}function xr(t){t.forEach(function(t){var e=t.matrix;e&&(t.matrix=ve(e,3,4))})}function Er(t,e){return void 0===e&&(e=9<t.length),"".concat(e?"matrix3d":"matrix","(").concat(be(t,!e).join(","),")")}function yr(t){var e=t.clientWidth,n=t.clientHeight;if(!t)return{x:0,y:0,width:0,height:0,clientWidth:e,clientHeight:n};t=t.viewBox,t=t&&t.baseVal||{x:0,y:0,width:0,height:0};return{x:t.x,y:t.y,width:t.width||e,height:t.height||n,clientWidth:e,clientHeight:n}}function X(t,e,n){return B(t,ge(e,n),n)}function Sr(e,t,n,r){return[[0,0],[t,0],[0,n],[t,n]].map(function(t){return X(e,t,r)})}function tt(t){var e=t.map(function(t){return t[0]}),t=t.map(function(t){return t[1]}),n=Math.min.apply(Math,e),r=Math.min.apply(Math,t),e=Math.max.apply(Math,e),t=Math.max.apply(Math,t);return{left:n,top:r,right:e,bottom:t,width:e-n,height:t-r}}function Mr(t,e,n,r){return tt(Sr(t,e,n,r))}function Cr(t,e,n,r){var i=16===t.length?4:3,n=Sr(t,n,r,i),r=n[0],o=r[0],r=r[1],a=n[1],s=a[0],a=a[1],u=n[2],c=u[0],u=u[1],l=n[3],f=l[0],l=l[1],t=X(t,e,i),e=t[0],i=t[1],t=Math.min(o,s,c,f),p=Math.min(r,a,u,l);return{left:t,top:p,right:Math.max(o,s,c,f),bottom:Math.max(r,a,u,l),origin:[e-t||0,i-p||0],pos1:[o-t||0,r-p||0],pos2:[s-t||0,a-p||0],pos3:[c-t||0,u-p||0],pos4:[f-t||0,l-p||0],direction:wt(n)}}function wr(t){return Math.sqrt(t[0]*t[0]+t[1]*t[1])}function Dr(t,e){return wr([e[0]-t[0],e[1]-t[1]])}function Rr(t,e,n,r){void 0===n&&(n=1),void 0===r&&(r=I(t,e));e=Dr(t,e);return{transform:"translateY(-50%) translate(".concat(t[0],"px, ").concat(t[1],"px) rotate(").concat(r,"rad) scaleY(").concat(n,")"),width:"".concat(e,"px")}}function Or(t,e){for(var n=[],r=2;r<arguments.length;r++)n[r-2]=arguments[r];var i=n.length,o=n.reduce(function(t,e){return t+e[0]},0)/i,i=n.reduce(function(t,e){return t+e[1]},0)/i;return{transform:"translateZ(0px) translate(".concat(o,"px, ").concat(i,"px) rotate(").concat(t,"rad) scale(").concat(e,")")}}function _r(t,e){e=t[e];return ot(e)?A(A({},t),e):t}function Pr(t,e){void 0===e&&(e=t?jr(t):null);var n,r,i,o,a,s,u,c,l=t&&!it(t.offsetWidth),f=0,p=0,d=0,h=0,g=0,v=0,m=0,b=0,x=0,E=0,y=0,S=0,M=1/0,C=1/0,w=1/0,D=1/0,R=!1;return t&&(h=l||"svg"===t.tagName.toLowerCase()?(l=t.style,n="border-box"===e.boxSizing,o=parseFloat(e.borderLeftWidth)||0,i=parseFloat(e.borderRightWidth)||0,a=parseFloat(e.borderTopWidth)||0,s=parseFloat(e.borderBottomWidth)||0,o=(r=(parseFloat(e.paddingLeft)||0)+(parseFloat(e.paddingRight)||0))+(o+i),a=(i=(parseFloat(e.paddingTop)||0)+(parseFloat(e.paddingBottom)||0))+(a+s),x=Math.max(r,Z(e.minWidth,0)||0),E=Math.max(i,Z(e.minHeight,0)||0),M=Z(e.maxWidth,0),C=Z(e.maxHeight,0),isNaN(M)&&(C=M=1/0),s=Z(l.width,0)||0,l=Z(l.height,0)||0,u=parseFloat(e.width)||0,c=parseFloat(e.height)||0,g=parseFloat(e.width),v=parseFloat(e.height),d=f=m=Math.abs(u-s)<1?St(x,s||g,M):u,h=p=b=Math.abs(c-l)<1?St(E,l||v,C):c,n?(w=M,D=C,y=x,S=E,m=f-o,b=p-a):(w=M+o,D=C+a,y=x+o,S=E+a,f=m+o,p=b+a),d=m+r,b+i):(R=!0,g=f=(e=t.getBBox()).width,v=p=e.height,d=m=f,b=p)),{svg:R,offsetWidth:f,offsetHeight:p,clientWidth:d,clientHeight:h,contentWidth:m,contentHeight:b,cssWidth:g,cssHeight:v,minWidth:x,minHeight:E,maxWidth:M,maxHeight:C,minOffsetWidth:y,minOffsetHeight:S,maxOffsetWidth:w,maxOffsetHeight:D}}function Br(t,e){return I(0<e?t[0]:t[1],0<e?t[1]:t[0])}function zr(){return{left:0,top:0,width:0,height:0,right:0,bottom:0,clientLeft:0,clientTop:0,clientWidth:0,clientHeight:0,scrollWidth:0,scrollHeight:0}}function Tr(t,e){var n=0,r=0,i=0,o=0,a=(t&&(t===document.body||t===document.documentElement?(i=window.innerWidth,o=window.innerHeight,n=(a=[-(a=[document.documentElement.scrollLeft||document.body.scrollLeft,document.documentElement.scrollTop||document.body.scrollTop])[0],-a[1]])[0],r=a[1]):(n=(a=t.getBoundingClientRect()).left,r=a.top,i=a.width,o=a.height)),{left:n,top:r,width:i,height:o,right:n+i,bottom:r+o});return t&&e&&(a.clientLeft=t.clientLeft,a.clientTop=t.clientTop,a.clientWidth=t.clientWidth,a.clientHeight=t.clientHeight,a.scrollWidth=t.scrollWidth,a.scrollHeight=t.scrollHeight,a.overflow="visible"!==jr(t).overflow),a}function Gr(t){if(t){var e,t=t.getAttribute("data-direction");if(t)return e=[0,0],-1<t.indexOf("w")&&(e[0]=-1),-1<t.indexOf("e")&&(e[0]=1),-1<t.indexOf("n")&&(e[1]=-1),-1<t.indexOf("s")&&(e[1]=1),e}}function kr(t,e){return[J(e,t[0]),J(e,t[1]),J(e,t[2]),J(e,t[3])]}function W(t){var e=t.left,n=t.top;return kr([t.pos1,t.pos2,t.pos3,t.pos4],[e,n])}function Ar(t,e){var n;null!=(n=t[e])&&n.unset(),t[e]=null}function Fr(e,t){return t&&((t=nr(t)).nextStyle=A(A({},t.nextStyle),e)),{style:e,cssText:yt(e).map(function(t){return"".concat(t,": ").concat(e[t],";")}).join("")}}function Ir(t,e,n){var r=e.afterTransform||e.transform;return A(A({},Fr(A(A(A({},t.style),e.style),{transform:r}),n)),{afterTransform:r,transform:t.transform})}function et(t,e,n,r){var i=e.datas,n=(i.datas||(i.datas={}),A(A({},n),{target:t.state.target,clientX:e.clientX,clientY:e.clientY,inputEvent:e.inputEvent,currentTarget:t,moveable:t,datas:i.datas,stopDrag:function(){var t;null!=(t=e.stop)&&t.call(e)}}));return i.isStartEvent?r||(i.lastEvent=n):i.isStartEvent=!0,n}function y(t,e,n){var r=e.datas,i=("isDrag"in n?n:e).isDrag;return r.datas||(r.datas={}),A(A({isDrag:i},n),{moveable:t,target:t.state.target,clientX:e.clientX,clientY:e.clientY,inputEvent:e.inputEvent,currentTarget:t,lastEvent:r.lastEvent,isDouble:e.isDouble,datas:r.datas})}function Nr(t,e,n){t._emitter.on(e,n)}function nt(t,e,n,r){return t.triggerEvent(e,n,r)}function jr(t,e){return window.getComputedStyle(t,e)}function Yr(t,n,r){var i={},o={};return t.filter(function(e){var t=e.name;if(i[t]||!n.some(function(t){return e[t]}))return!1;if(!r&&e.ableGroup){if(o[e.ableGroup])return!1;o[e.ableGroup]=!0}return i[t]=!0})}function Xr(t,e){return t===e||null==t&&null==e}function Wr(t){return t.reduce(function(t,e){return t.concat(e)},[])}function qr(){for(var t=[],e=0;e<arguments.length;e++)t[e]=arguments[e];return t.sort(function(t,e){return Math.abs(e)-Math.abs(t)}),t[0]}function Lr(t,e,n){return B(de(t,n),ge(e,n),n)}function Hr(t,e){var n=t.is3d,t=Lr(t.rootMatrix,[e.distX,e.distY],n?4:3);return e.distX=t[0],e.distY=t[1],e}function Vr(t,e,n,r,i){return T(X(t,J(n,e),i),r)}function Ur(t,e,n){return n?"".concat(t/e*100,"%"):"".concat(t,"px")}function $r(t){return Math.abs(t)<=F?0:t}function Zr(r,i){return void 0===i&&(i=[r]),function(t,e){if(e.isRequest)return!!i.some(function(t){return e.requestAble===t})&&e.parentDirection;var n=e.inputEvent.target;return P(n,G("direction"))&&(!r||P(n,G(r)))}}function Kr(t){var e,n={};for(e in t)n[t[e]]=e;return n}function Jr(t,e){return t?t instanceof Element?t:b(t)?e?document.querySelector(t):t:st(t)?t():"current"in t?t.current:t:null}function Qr(t,n){return t?((e=t)&&ot(e)&&(!(e instanceof Element)&&(D(e)||"length"in e))?[].slice.call(t):[t]).reduce(function(t,e){return b(e)&&n?Q(Q([],t,!0),[].slice.call(document.querySelectorAll(e)),!0):(D(e)?t.push(Qr(e,n)):t.push(Jr(e,n)),t)},[]):[];var e}function ti(t,e){var n=t.rootMatrix,t=t.is3d,n=de(n,t?4:3);return(n=t?n:ve(n,3,4))[12]=0,n[13]=0,n[14]=0,n=(t=B(t=n,[(n=e)[0],n[1]||0,n[2]||0,1],4))[3]||1,[t[0]/n,t[1]/n,t[2]/n]}function ei(t,e,n,r,i){var o,a,s=t[0],t=t[1],u=0,c=0;return i&&s&&t?(i=I([0,0],e),o=I([0,0],r),a=wr(e),i=Math.cos(i-o)*a,r[0]?c=r[1]?(o=2*r[0]*s,a=2*r[1]*t,s=wr([o+e[0],a+e[1]])-wr([o,a]),t=I([0,0],[n,1]),u=Math.cos(t)*s,Math.sin(t)*s):(u=i)/n:u=(c=i)*n):(u=r[0]*e[0],c=r[1]*e[1]),[u,c]}function ni(e,t,n,r){var i,o,a=n.ratio,s=n.startOffsetWidth,u=n.startOffsetHeight,c=0,l=0,f=r.distX,p=r.distY,d=r.parentDistance,h=r.parentDist,r=r.parentScale,g=n.fixedDirection,v=[0,1].map(function(t){return Math.abs(e[t]-g[t])}),m=[0,1].map(function(t){t=v[t];return t=0!==t?2/t:t});return h?(c=h[0],l=h[1],t&&(c?l=l||c/a:c=l*a)):l=r?(c=(r[0]-1)*s,(r[1]-1)*u):d?(c=d/(i=wr([h=s*v[0],r=u*v[1]]))*h*m[0],d/i*r*m[1]):(o=$n({datas:n,distX:f,distY:p}),c=(h=ei([s,u],o=m.map(function(t,e){return o[e]*t}),a,e,t))[0],h[1]),{distWidth:c,distHeight:l}}ue=En("pinchable",{events:{onPinchStart:"pinchStart",onPinch:"pinch",onPinchEnd:"pinchEnd",onPinchGroupStart:"pinchGroupStart",onPinchGroup:"pinchGroup",onPinchGroupEnd:"pinchGroupEnd"},dragStart:function(){return!0},pinchStart:function(n,r){var t=r.datas,e=r.targets,i=r.angle,o=r.originalDatas,a=n.props,s=a.pinchable,a=a.ables;if(!s)return!1;var u="onPinch".concat(e?"Group":"","Start"),c="drag".concat(e?"Group":"","ControlStart"),a=(!0===s?n.controlAbles:a.filter(function(t){return-1<s.indexOf(t.name)})).filter(function(t){return t.canPinch&&t[c]}),l=et(n,r,{}),e=(e&&(l.targets=e),nt(n,u,l)),u=(t.isPinch=!1!==e,t.ables=a,t.isPinch);return!!u&&(a.forEach(function(t){var e;o[t.name]=o[t.name]||{},t[c]&&(e=A(A({},r),{datas:o[t.name],parentRotate:i,isPinch:!0}),t[c](n,e))}),n.state.snapRenderInfo={request:r.isRequest,direction:[0,0]},u)},pinch:function(e,n){var r,i,t=n.datas,o=n.scale,a=n.distance,s=n.originalDatas,u=n.inputEvent,c=n.targets,l=n.angle;if(t.isPinch)return r=a*(1-1/o),a=et(e,n,{}),c&&(a.targets=c),o="onPinch".concat(c?"Group":""),nt(e,o,a),o=t.ables,i="drag".concat(c?"Group":"","Control"),o.forEach(function(t){t[i]&&t[i](e,A(A({},n),{datas:s[t.name],inputEvent:u,parentDistance:r,parentRotate:l,isPinch:!0}))}),a},pinchEnd:function(e,n){var t,r,i,o=n.datas,a=n.isPinch,s=n.inputEvent,u=n.targets,c=n.originalDatas;if(o.isPinch)return r="onPinch".concat(u?"Group":"","End"),t=y(e,n,{isDrag:a}),u&&(t.targets=u),nt(e,r,t),r=o.ables,i="drag".concat(u?"Group":"","ControlEnd"),r.forEach(function(t){t[i]&&t[i](e,A(A({},n),{isDrag:a,datas:c[t.name],inputEvent:s,isPinch:!0}))}),a},pinchGroupStart:function(t,e){return this.pinchStart(t,A(A({},e),{targets:t.props.targets}))},pinchGroup:function(t,e){return this.pinch(t,A(A({},e),{targets:t.props.targets}))},pinchGroupEnd:function(t,e){return this.pinchEnd(t,A(A({},e),{targets:t.props.targets}))}});function ri(t,n,r){var e=r.originalDatas,e=(e.groupable=e.groupable||{},e.groupable),i=(e.childDatas=e.childDatas||[],e.childDatas);return t.moveables.map(function(t,e){return i[e]=i[e]||{},i[e][n]=i[e][n]||{},A(A({},r),{datas:i[e][n],originalDatas:i[e]})})}function ii(t,a,s,u,e,c,l){var f=!!s.match(/Start$/g),p=!!s.match(/End$/g),d=e.isPinch,h=e.datas,e=ri(t,a.name,e),g=t.moveables,t=e.map(function(t,e){var n=g[e],r=n.state,i=r.gestos,o=t;if(f)o=new Yn(l).dragStart(u,t);else{if(i[l]||(i[l]=h.childGestos[e]),!i[l])return;o=jn(t,r,u,d,c,l)}e=a[s](n,A(A({},o),{parentFlag:!0}));return p&&(i[l]=null),e});return f&&(h.childGestos=g.map(function(t){return t.state.gestos[l]})),t}function oi(t,i,o,e,a,s){void 0===a&&(a=function(t,e){return e});var u=!!o.match(/End$/g),e=ri(t,i.name,e),c=t.moveables;return e.map(function(t,e){var n=c[e],r=a(n,t),r=i[o](n,A(A({},r),{parentFlag:!0}));return r&&s&&s(n,t,r,e),u&&(n.state.gestos={}),r})}var ai=["left","right","center"],si=["top","bottom","middle"],ui={start:"left",end:"right",center:"center"},ci={start:"top",end:"bottom",center:"middle"};function li(t,e){var n=t.props,r=n.snappable,i=n.bounds,o=n.innerBounds,a=n.verticalGuidelines,s=n.horizontalGuidelines,u=n.snapGridWidth,n=n.snapGridHeight,t=t.state,c=t.guidelines,t=t.enableSnap;return r&&t&&!(e&&!0!==r&&r.indexOf(e)<0)&&!!(u||n||i||o||c&&c.length||a&&a.length||s&&s.length)}function fi(t){return!1===t?{}:!0!==t&&t?t:{left:!0,right:!0,top:!0,bottom:!0}}function pi(t,e){var n=function(t,e){var n,r=fi(t),i={};for(n in r)n in e&&r[n]&&(i[n]=e[n]);return i}(t,e),t=si.filter(function(t){return t in n}),e=ai.filter(function(t){return t in n});return{horizontal:t.map(function(t){return n[t]}),vertical:e.map(function(t){return n[t]})}}function di(t,e,n,r){r=function(){for(var t=[],e=0;e<arguments.length;e++)t[e]=arguments[e];for(var n=t.length-1,r=0;r<n;++r){var i=t[r];if(!it(i))return i}return t[n]}(r,t.props.snapThreshold,5);return hi(t.state.guidelines,e,n,r)}function hi(t,e,n,r){return{vertical:mi(t,"vertical",e,r),horizontal:mi(t,"horizontal",n,r)}}function gi(t,e,n){e=pi(t.props.snapDirections,e);return di(t,e.vertical,e.horizontal,n)}function vi(t){var e=t.isSnap;if(!e)return{isSnap:!1,offset:0,dist:-1,pos:0,guideline:null};var t=t.posInfos[0],n=t.guidelineInfos[0],r=n.offset,i=n.dist,n=n.guideline;return{isSnap:e,offset:r,dist:i,pos:t.pos,guideline:n}}function mi(r,i,t,o){if(!r||!r.length)return{isSnap:!1,index:-1,posInfos:[]};var a="vertical"===i?0:1,t=t.map(function(n,t){var e=r.map(function(t){var e=t.pos,e=n-e[a];return{offset:e,dist:Math.abs(e),guideline:t}}).filter(function(t){var e=t.guideline,t=t.dist;return!(e.type!==i||o<t)}).sort(function(t,e){return t.dist-e.dist});return{pos:n,index:t,guidelineInfos:e}}).filter(function(t){return 0<t.guidelineInfos.length}).sort(function(t,e){return t.guidelineInfos[0].dist-e.guidelineInfos[0].dist}),e=0<t.length;return{isSnap:e,index:e?t[0].index:-1,posInfos:t}}function bi(t,e,n){var r,i=[];if(n[0]&&n[1])i=[n,[-n[0],n[1]],[n[0],-n[1]]].map(function(t){return j(e,t)});else if(n[0]||n[1])t.props.keepRatio?i=[[-1,-1],[-1,1],[1,-1],[1,1],n].map(function(t){return j(e,t)}):(r=e,1<(i=Zn(n).map(function(t){return r[t]})).length&&i.push([(i[0][0]+i[1][0])/2,(i[0][1]+i[1][1])/2]));else for(var o=[e[0],e[1],e[3],e[2],e[0]],a=0;a<4;++a)i.push(o[a]),i.push([(o[a][0]+o[a+1][0])/2,(o[a][1]+o[a+1][1])/2]);return di(t,i.map(function(t){return t[0]}),i.map(function(t){return t[1]}),1)}function xi(t,e){var n=Math.abs(t.offset),r=Math.abs(e.offset);return t.isBound&&e.isBound?r-n:t.isBound?-1:e.isBound?1:t.isSnap&&e.isSnap?r-n:t.isSnap?-1:e.isSnap||n<F?1:r<F?-1:n-r}function Ei(t,a){return t.slice().sort(function(t,e){var n=t.sign[a],r=e.sign[a],i=t.offset[a],o=e.offset[a];return n?r?xi({isBound:t.isBound,isSnap:t.isSnap,offset:i},{isBound:e.isBound,isSnap:e.isSnap,offset:o}):-1:1})[0]}function yi(t,e){var n=Ct([e[0][0],e[1][0]]),e=Ct([e[0][1],e[1][1]]);return{vertical:n<=t[0],horizontal:e<=t[1]}}function Si(t,e){var n,r=e[0],e=e[1],i=e[0]-r[0],e=e[1]-r[1];return Math.abs(i)<F&&(i=0),Math.abs(e)<F&&(e=0),e=i?(n=e?e/i*(t[0]-r[0])+r[1]:r[1],t[1]):(n=r[0],t[0]),n-e}function Mi(t,e,n,r){return void 0===r&&(r=F),t.every(function(t){t=Si(t,e);return t<=0===n||Math.abs(t)<=r})}function Ci(t,e,n,r,i){return void 0===i&&(i=0),r&&e-i<=t||!r&&t<=n+i?{isBound:!0,offset:r?e-t:n-t}:{isBound:!1,offset:0}}function wi(t,e,n,r,i,o){var a,s,u=e[0],e=e[1],t=t[0],c=n[0],n=n[1],l=$r(n[1]-c[1]),f=e,p=u,u=-u/e;return $r(n[0]-c[0])?l||o&&!f?{isBound:!1,offset:0}:p?Ci((c[1]-t[1])/u+t[0],c[0],n[0],r,i):(a=c[1]-t[1],{isBound:s=Math.abs(a)<=(i||0),offset:s?a:0}):o&&!p?{isBound:!1,offset:0}:f?Ci(u*(c[0]-t[0])+t[1],c[1],n[1],r,i):(a=c[0]-t[0],{isBound:s=Math.abs(a)<=(i||0),offset:s?a:0})}function Di(a,t,s){return t.map(function(t){var e=function(t,e){var n=e.line,r=e.centerSign,i=e.verticalSign,o=e.horizontalSign,e=e.lineConstants;if(!(t=t.props.innerBounds))return{isAllBound:!1,isBound:!1,isVerticalBound:!1,isHorizontalBound:!1,offset:[0,0]};var a=t.left,s=t.top,u=t.width,t=t.height,c=[[a,s],[a,s+t]],l=[[a,s],[a+u,s]],f=[[a+u,s],[a+u,s+t]],p=[[a,s+t],[a+u,s+t]];return Mi([[a,s],[a+u,s],[a,s+t],[a+u,s+t]],n,r)?{isAllBound:!1,isBound:!1,isVerticalBound:!1,isHorizontalBound:!1,offset:[0,0]}:(a=wi(n,e,l,i),u=wi(n,e,p,i),s=wi(n,e,c,o),t=wi(n,e,f,o),r=a.isBound&&u.isBound,l=a.isBound||u.isBound,p=s.isBound&&t.isBound,i=s.isBound||t.isBound,c=qr(a.offset,u.offset),n=qr(s.offset,t.offset),f=!(e=[0,0]),{isAllBound:Math.abs(n)<Math.abs(c)?(e=[c,0],f=l,r):(e=[0,n],f=i,p),isVerticalBound:l,isHorizontalBound:i,isBound:f,offset:e})}(a,t),n=e.isBound,r=e.offset,i=e.isVerticalBound,e=e.isHorizontalBound,o=t.multiple,t=$n({datas:s,distX:r[0],distY:r[1]}).map(function(t,e){return t*(o[e]?2/o[e]:0)});return{sign:o,isBound:n,isVerticalBound:i,isHorizontalBound:e,isSnap:!1,offset:t}})}function Ri(t,e,n){var r,i,o,a,s,u,t=Di(t,Oi(t,e,[0,0],!1).map(function(t){return A(A({},t),{multiple:t.multiple.map(function(t){return 2*Math.abs(t)})})}),n),e=Ei(t,0),t=Ei(t,1),c=0,l=0,f=e.isVerticalBound||t.isVerticalBound,p=e.isHorizontalBound||t.isHorizontalBound;return(f||p)&&(n={datas:n,distX:-e.offset[0],distY:-t.offset[1]},e=n.datas,t=n.distX,n=n.distY,i=e.beforeMatrix,o=e.matrix,a=e.is3d,s=e.startDragBeforeDist,u=e.startDragDist,e=e.absoluteOrigin,a=a?4:3,c=(i=T(B(r?i:o,J(r?s:u,[t,n]),a),e))[0],l=i[1]),{vertical:{isBound:f,offset:c},horizontal:{isBound:p,offset:l}}}function Oi(t,l,e,n){var r,i,t=t.state,f=Sr(t.allMatrix,100,100,t.is3d?4:3),p=j(f,[0,0]);return t=n,n=[],r=(e=e)[0],i=e[1],r&&i?n.push([[0,2*i],e,[-r,i]],[[2*r,0],e,[r,-i]]):r?(n.push([[2*r,0],[r,1],[r,-1]]),t&&n.push([[0,-1],[r,-1],[-r,-1]],[[0,1],[r,1],[-r,1]])):i?(n.push([[0,2*i],[1,i],[-1,i]]),t&&n.push([[-1,0],[-1,i],[-1,-i]],[[1,0],[1,i],[1,-i]])):n.push([[-1,0],[-1,-1],[-1,1]],[[1,0],[1,-1],[1,1]],[[0,-1],[-1,-1],[1,-1]],[[0,1],[-1,1],[1,1]]),n.map(function(t){var e,n,r=t[0],i=t[1],t=t[2],o=[j(f,i),j(f,t)],a=(u=(a=o)[0],s=(a=a[1])[0]-u[0],a=a[1]-u[1],Math.abs(s)<k&&(s=0),Math.abs(a)<k&&(a=0),n=e=c=0,n=s?a?(c=-a/s)*u[0]-u[e=1]:-u[e=1]:(c=-1,u[0]),[c,e,n].map(function(t){return N(t,k)})),s=yi(p,o),u=s.vertical,c=s.horizontal;return{multiple:r,centerSign:Si(p,o)<=0,verticalSign:u,horizontalSign:c,lineConstants:a,line:[j(l,i),j(l,t)]}})}function _i(t,n,r,e){t=e?t.map(function(t){return Me(t,e)}):t;return[[t[0],t[1]],[t[1],t[3]],[t[3],t[2]],[t[2],t[0]]].some(function(t){var e=Si(r,t)<=0;return!Mi(n,t,e)})}function Pi(t,a,e,n,r){var t=t.props.innerBounds,s=r*Math.PI/180;if(!t)return[];var r=t.left,i=t.top,o=t.width,t=t.height,u=r-n[0],r=r+o-n[0],o=i-n[1],i=i+t-n[1],c=[[u,o],[r,o],[u,i],[r,i]],l=j(e,[0,0]);if(!_i(e,c,l,0))return[];var f=[],p=c.map(function(t){return[wr(t),I([0,0],t)]});return[[e[0],e[1]],[e[1],e[3]],[e[3],e[2]],[e[2],e[0]]].forEach(function(t){var e,n,r,i=I([0,0],(r=(n=t)[0],e=(n=n[1])[0]-r[0],n=n[1]-r[1],e?n?[-(e=-(n/=e)*r[0]+r[1])/(n+1/n),e/(n*n+1)]:[0,r[1]]:[r[0],0])),o=(n=(e=t)[0],r=(e=e[1])[0]-n[0],e=e[1]-n[1],r?e?(e/=r,Math.abs((-e*n[0]+n[1])/Math.sqrt(Math.pow(e,2)+1))):Math.abs(n[1]):Math.abs(n[0]));f.push.apply(f,p.filter(function(t){t=t[0];return t&&o<=t}).map(function(t){var e=t[0],t=t[1],e=Math.acos(e?o/e:0);return[s+(t+e)-i,s+(t-e)-i]}).reduce(function(t,e){return t.push.apply(t,e),t},[]).filter(function(t){return!_i(a,c,l,t)}).map(function(t){return N(180*t/Math.PI,F)}))}),f}function Bi(t,e,n){var t=t||{},r=t.position,i=t.left,o=t.top,a=t.right,t=t.bottom,r={position:void 0===r?"client":r,left:void 0===i?-1/0:i,top:void 0===o?-1/0:o,right:void 0===a?1/0:a,bottom:void 0===t?1/0:t};return{vertical:Ti(r,e,!0),horizontal:Ti(r,n,!1)}}function zi(t,e){var n=t.state,r=n.containerClientRect,i=r.clientHeight,o=r.clientWidth,a=r.clientLeft,r=r.clientTop,n=n.snapOffset,s=n.left,u=n.top,c=n.right,n=n.bottom,e=e||t.props.bounds||{},t="css"===(e.position||"client"),l=e.left,f=e.top,p=e.right,p=void 0===p?t?-1/0:1/0:p,e=e.bottom,e=void 0===e?t?-1/0:1/0:e;return t&&(p=o+c-s-p,e=i+n-u-e),{left:(void 0===l?-1/0:l)+s-a,right:p+s-a,top:(void 0===f?-1/0:f)+u-r,bottom:e+u-r}}function Ti(t,e,n){var r=t[n?"left":"top"],t=t[n?"right":"bottom"],n=Math.min.apply(Math,e),e=Math.max.apply(Math,e),i=[];return n<r+1&&i.push({isBound:!0,offset:n-r,pos:r}),t-1<e&&i.push({isBound:!0,offset:e-t,pos:t}),i.length||i.push({isBound:!1,offset:0,pos:0}),i.sort(function(t,e){return Math.abs(e.offset)-Math.abs(t.offset)})}function Gi(t,e,n){return(n?t.map(function(t){return Me(t,n)}):t).some(function(t){return t[0]<e.left&&.1<Math.abs(t[0]-e.left)||t[0]>e.right&&.1<Math.abs(t[0]-e.right)||t[1]<e.top&&.1<Math.abs(t[1]-e.top)||t[1]>e.bottom&&.1<Math.abs(t[1]-e.bottom)})}function ki(t,s,e,n,r){if(!t.props.bounds)return[];var u=r*Math.PI/180,r=zi(t),t=r.left,i=r.top,o=r.right,r=r.bottom,t=t-n[0],o=o-n[0],i=i-n[1],r=r-n[1],c={left:t,top:i,right:o,bottom:r};if(!Gi(e,c,0))return[];var l=[];return[[t,0],[o,0],[i,1],[r,1]].forEach(function(t){var o=t[0],a=t[1];e.forEach(function(t){var n,e,r,i=I([0,0],t);l.push.apply(l,(e=o,r=a,t=wr(n=t),[t=Math.sqrt(t*t-e*e)||0,-t].sort(function(t,e){return Math.abs(t-n[r?0:1])-Math.abs(e-n[r?0:1])}).map(function(t){return I([0,0],r?[t,e]:[e,t])}).map(function(t){return u+t-i}).filter(function(t){return!Gi(s,c,t)}).map(function(t){return N(180*t/Math.PI,F)})))})}),l}function Ai(t,e){return t=A(A({},t),{classNames:Q([G("line","guideline",t.direction)],t.classNames,!0).filter(function(t){return t}),size:t.size||"".concat(t.sizeValue,"px"),pos:t.pos||t.posValue.map(function(t){return"".concat(N(t,.1),"px")})}),e=e,n=t.direction,r=t.classNames,i=t.size,o=t.pos,a=t.zoom,t=t.key,s=(n="horizontal"===n)?"Y":"X",e.createElement("div",{key:t,className:r.join(" "),style:((e={})[n?"width":"height"]="".concat(i),e.transform="translate(".concat(o[0],", ").concat(o[1],") translate").concat(s,"(-50%) scale").concat(s,"(").concat(a,")"),e)});var n,r,i,o,a,s}function Fi(t,i,e,o,a,s,u,c){var l=t.props.zoom;return e.map(function(t,e){var n=t.type,t=t.pos,r=[0,0];return r[u]=o,r[u?0:1]=-a+t,Ai({key:"".concat(i,"TargetGuideline").concat(e),classNames:[G("target","bold",n)],posValue:r,sizeValue:s,zoom:l,direction:i},c)})}function Ii(t,o,e,a,n,s){var t=t.props,u=t.zoom,r=t.isDisplayInnerSnapDigit,i="horizontal"===o?ui:ci,c=n[i.start],l=n[i.end];return e.filter(function(t){var e=t.hide,t=t.elementRect;if(e)return!1;if(r&&t){e=t.rect;if(e[i.start]<=c&&l<=e[i.end])return!1}return!0}).map(function(t,e){var n=t.pos,r=t.size,i=t.element,t=t.className,n=[-a[0]+n[0],-a[1]+n[1]];return Ai({key:"".concat(o,"-default-guideline-").concat(e),classNames:i?[G("bold"),t]:[G("normal"),t],direction:o,posValue:n,sizeValue:r,zoom:u},s)})}function Ni(t,e,n,r,i,o,a,s){var t=t.props,u=t.snapDigit,u=void 0===u?0:u,c=t.isDisplaySnapDigit,c=void 0===c||c,l=t.snapDistFormat,l=void 0===l?function(t,e){return t}:l,t=t.zoom,f="horizontal"===e?"X":"Y",p="vertical"===e?"height":"width",i=Math.abs(i),c=c?parseFloat(i.toFixed(u)):0;return s.createElement("div",{key:"".concat(e,"-").concat(n,"-guideline-").concat(r),className:G("guideline-group",e),style:((u={left:"".concat(o[0],"px"),top:"".concat(o[1],"px")})[p]="".concat(i,"px"),u)},Ai({direction:e,classNames:[G(n),a],size:"100%",posValue:[0,0],sizeValue:i,zoom:t},s),s.createElement("div",{className:G("size-value","gap"),style:{transform:"translate".concat(f,"(-50%) scale(").concat(t,")")}},0<c?l(c,e):""))}function ji(S,e,M,C,w){var n=S.props.isDisplayInnerSnapDigit,D=[];return["vertical","horizontal"].forEach(function(a){var u,c,i,o,s,l,f,p,d,h,g,t=e.filter(function(t){return t.type===a}),v="vertical"===a?1:0,m=v?0:1,t=(t=t,c=n,p="vertical"===(u=a)?1:0,h=C[(d=(f="vertical"===u?0:1)?ui:ci).start],g=C[d.end],o=function(t){return t.pos[f]},s=[],l=[],(i=t).forEach(function(t,e){var e=o(t,e,i),n=l.indexOf(e),r=s[n]||[];-1===n&&(l.push(e),s.push(r)),r.push(t)}),s.map(function(t){var a=[],s=[];return t.forEach(function(t){var e,n,r,i=t.element,o=t.elementRect.rect;o[d.end]<h?a.push(t):g<o[d.start]?s.push(t):o[d.start]<=h&&g<=o[d.end]&&c&&(e=t.pos,n={element:i,rect:A(A({},o),((n={})[d.end]=o[d.start],n))},o={element:i,rect:A(A({},o),((i={})[d.start]=o[d.end],i))},i=[0,0],(r=[0,0])[f]=e[f],r[p]=e[p],i[f]=e[f],i[p]=e[p]+t.size,a.push({type:u,pos:r,size:0,elementRect:n}),s.push({type:u,pos:i,size:0,elementRect:o}))}),a.sort(function(t,e){return e.pos[p]-t.pos[p]}),s.sort(function(t,e){return t.pos[p]-e.pos[p]}),{total:t,start:a,end:s,inner:[]}})),b=v?ci:ui,x=v?ui:ci,E=C[b.start],y=C[b.end];t.forEach(function(t){var e=t.total,n=t.start,r=t.end,t=t.inner,o=M[m]+e[0].pos[m]-C[x.start],i=C;n.forEach(function(t){var e,n=t.elementRect.rect,r=i[b.start]-n[b.end];0<r&&((e=[0,0])[v]=M[v]+i[b.start]-E-r,e[m]=o,D.push(Ni(S,a,"dashed",D.length,r,e,t.className,w))),i=n}),i=C,r.forEach(function(t){var e,n=t.elementRect.rect,r=n[b.start]-i[b.end];0<r&&((e=[0,0])[v]=M[v]+i[b.end]-E,e[m]=o,D.push(Ni(S,a,"dashed",D.length,r,e,t.className,w))),i=n}),t.forEach(function(t){var e=t.elementRect.rect,n=E-e[b.start],e=e[b.end]-y,r=[0,0],i=[0,0];r[v]=M[v]-n,r[m]=o,i[v]=M[v]+y-E,i[m]=o,D.push(Ni(S,a,"dashed",D.length,n,r,t.className,w)),D.push(Ni(S,a,"dashed",D.length,e,i,t.className,w))})})}),D}function Yi(t,e,n,r,i){o=t,n=n,r=r,a=(u=e)[0]-o[0],s=u[1]-o[1],Math.abs(a)<k&&(a=0),Math.abs(s)<k&&(s=0);var o=a?s?(s/=a,a=o[1]-s*o[0],r?[n,s*(u[0]+n)+a-u[1]]:[(u[1]+n-a)/s-u[0],n]):r?[n,0]:[0,0]:r?[0,0]:[0,n];if(!o)return{isOutside:!1,offset:[0,0]};var a=C(t,e),s=C(o,t),u=C(o,e),r=a<s||a<u,n=$n({datas:i,distX:o[0],distY:o[1]});return{offset:[n[0],n[1]],isOutside:r}}function Xi(t,e){return t.isBound?t.offset:e.isSnap?vi(e).offset:0}function Wi(t,e,n,r,i,o){if(!li(t,"draggable"))return[{isSnap:!1,isBound:!1,offset:0},{isSnap:!1,isBound:!1,offset:0}];var a,s,u,c,l=kr(o.absolutePoses,[e,n]),f=tt(l),p=f.left,d=f.right,h=f.top,f=f.bottom,g={horizontal:l.map(function(t){return t[1]}),vertical:l.map(function(t){return t[0]})},i=qi(t,i,pi(fi(t.props.snapDirections),{left:p,right:d,top:h,bottom:f,center:(p+d)/2,middle:(h+f)/2}),g),p=i.vertical,d=i.horizontal,h=Ri(t,l,o),f=h.vertical,g=h.horizontal,i=p.isSnap,t=d.isSnap,l=p.isBound||f.isBound,o=d.isBound||g.isBound,h=qr(p.offset,f.offset),p=qr(d.offset,g.offset),v=(f=r,d=[l,o],g=[i,t],r=[h,p],s=(h=[e,n])[0],u=h[1],h=d[0],d=d[1],p=g[0],g=g[1],e=r[0],r=r[1],n=-e,c=-r,f&&s&&u?(c=n=0,v=[],h&&d?v.push([0,r],[e,0]):h?v.push([e,0]):d?v.push([0,r]):p&&g?v.push([0,r],[e,0]):p?v.push([e,0]):g&&v.push([0,r]),v.length&&(v.sort(function(t,e){return wr(T([s,u],t))-wr(T([s,u],e))}),(p=v[0])[0]&&Math.abs(s)>k?(n=-p[0],c=u*Math.abs(s+n)/Math.abs(s)-u):p[1]&&Math.abs(u)>k&&(g=u,c=-p[1],n=s*Math.abs(u+c)/Math.abs(g)-s),f&&d&&h&&(Math.abs(n)>k&&Math.abs(n)<Math.abs(e)?(n*=a=Math.abs(e)/Math.abs(n),c*=a):Math.abs(c)>k&&Math.abs(c)<Math.abs(r)?(n*=a=Math.abs(r)/Math.abs(c),c*=a):(n=qr(-e,n),c=qr(-r,c))))):(n=s||h?-e:0,c=u||d?-r:0),[n,c]);return[{isBound:l,isSnap:i,offset:v[0]},{isBound:o,isSnap:t,offset:v[1]}]}function qi(t,e,n,r){var r=Bi(zi(t),(r=void 0===r?n:r).vertical,r.horizontal),i=r.horizontal,r=r.vertical,e=e?{horizontal:{isSnap:!1,index:-1},vertical:{isSnap:!1,index:-1}}:di(t,n.vertical,n.horizontal),t=e.horizontal,n=e.vertical,e=Xi(i[0],t),o=Xi(r[0],n),a=Math.abs(e),s=Math.abs(o);return{horizontal:{isBound:i[0].isBound,isSnap:t.isSnap,snapIndex:t.index,offset:e,dist:a,bounds:i,snap:t},vertical:{isBound:r[0].isBound,isSnap:n.isSnap,snapIndex:n.index,offset:o,dist:s,bounds:r,snap:n}}}function Li(t,e,n,r,i){var e=Bi(e,n,r),o=e.horizontal,e=e.vertical,t=hi(t,n,r,i),n=t.horizontal,r=t.vertical,i=Xi(o[0],n),t=Xi(e[0],r),a=Math.abs(i),s=Math.abs(t);return{horizontal:{isBound:o[0].isBound,isSnap:n.isSnap,snapIndex:n.index,offset:i,dist:a,bounds:o,snap:n},vertical:{isBound:e[0].isBound,isSnap:r.isSnap,snapIndex:r.index,offset:t,dist:s,bounds:e,snap:r}}}function Hi(M,C,t,w,D,R){return t.map(function(t){var e=t[0],t=t[1],n=j(C,e),r=j(C,t),i=w?(l=D,u=function(t,e,n){var r,i,o=(t=zi(t)).left,a=t.top,s=t.right,t=t.bottom,u=n[0],c=n[1],l=(e=T(n,e))[0],e=e[1],f=(Math.abs(l)<F&&(l=0),0<(e=Math.abs(e)<F?0:e)),p=0<l,d={isBound:!1,offset:0,pos:0},h={isBound:!1,offset:0,pos:0};return 0===l&&0===e||(0===l?f?t<c&&(h.pos=t,h.offset=c-t):c<a&&(h.pos=a,h.offset=c-a):0===e?p?s<u&&(d.pos=s,d.offset=u-s):u<o&&(d.pos=o,d.offset=u-o):(e=n[1]-(n=e/l)*u,r=l=0,i=!1,p&&s<=u?(l=n*s+e,r=s,i=!0):!p&&u<=o&&(l=n*o+e,r=o,i=!0),(i=i&&(l<a||t<l)?!1:i)||(f&&t<=c?(r=((l=t)-e)/n,i=!0):!f&&c<=a&&(r=((l=a)-e)/n,i=!0)),i&&(d.isBound=!0,d.pos=r,d.offset=u-r,h.isBound=!0,h.pos=l,h.offset=c-l))),{vertical:d,horizontal:h}}(o=M,c=n,a=r),i=u.horizontal,u=u.vertical,l=l?{horizontal:{isSnap:!1},vertical:{isSnap:!1}}:function(t,e,n){var r=n[0],i=n[1],o=e[0],a=e[1],s=(e=T(n,e))[0],u=0<(e=e[1]),c=0<s,s=$r(s),e=$r(e),l={isSnap:!1,offset:0,pos:0},f={isSnap:!1,offset:0,pos:0};if(0===s&&0===e)return{vertical:l,horizontal:f};var p,d=(t=di(t,s?[r]:[],e?[i]:[])).vertical,t=t.horizontal;d.posInfos.filter(function(t){t=t.pos;return c?o<=t:t<=o}),t.posInfos.filter(function(t){t=t.pos;return u?a<=t:t<=a}),d.isSnap=0<d.posInfos.length,t.isSnap=0<t.posInfos.length;var h=(d=vi(d)).isSnap,d=d.guideline,g=(t=vi(t)).isSnap,t=t.guideline,v=g?t.pos[1]:0,d=h?d.pos[0]:0;return 0===s?g&&(f.isSnap=!0,f.pos=t.pos[1],f.offset=i-f.pos):0===e?h&&(l.isSnap=!0,l.pos=d,l.offset=r-d):(n=n[1]-(t=e/s)*r,s=e=0,p=!1,h?(e=t*(s=d)+n,p=!0):g&&(s=((e=v)-n)/t,p=!0),p&&(l.isSnap=!0,l.pos=s,l.offset=r-s,f.isSnap=!0,f.pos=e,f.offset=i-e)),{vertical:l,horizontal:f}}(o,c,a),o=l.horizontal,c=l.vertical,a=Vi(i,o),l=Vi(u,c),s=Math.abs(a),f=Math.abs(l),{horizontal:{isBound:i.isBound,isSnap:o.isSnap,offset:a,dist:s},vertical:{isBound:u.isBound,isSnap:c.isSnap,offset:l,dist:f}}):qi(M,D,{vertical:[r[0]],horizontal:[r[1]]}),o=i.horizontal,a=o.offset,s=o.isBound,u=o.isSnap,c=i.vertical,l=c.offset,f=c.isBound,p=c.isSnap,d=T(t,e);if(!l&&!a)return{isBound:f||s,isSnap:p||u,sign:d,offset:[0,0]};E=i,g=w,h=I(h=n,y=r)/Math.PI*180,S=(y=E.vertical).isBound,v=y.isSnap,y=y.dist,m=(E=E.horizontal).isBound,b=E.isSnap,x=(h=h%180)<3||177<h,h=87<h&&h<93;var h,g,v,m,b,x,E=E.dist<y&&(S||v&&!h&&(!g||!x))?"vertical":!m&&(!b||x||g&&h)?"":"horizontal";if(!E)return{sign:d,isBound:!1,isSnap:!1,offset:[0,0]};var y="vertical"==E,S=[0,0];return S=(S=w||1!==Math.abs(t[0])||1!==Math.abs(t[1])||e[0]===t[0]||e[1]===t[1]?Yi(n,r,-(y?l:a),y,R).offset:$n({datas:R,distX:-l,distY:-a})).map(function(t,e){return t*(d[e]?2/d[e]:0)}),{sign:d,isBound:y?f:s,isSnap:y?p:u,offset:S}})}function Vi(t,e){return t.isBound?t.offset:e.isSnap?e.offset:0}function Ui(t){var m,b,x,E,o,y,e=t.state,n=e.snapOffset,e=e.containerClientRect,r=e.overflow,i=e.scrollHeight,a=e.scrollWidth,s=e.clientHeight,u=e.clientWidth,c=e.clientLeft,e=e.clientTop,l=t.props,f=l.snapGap,f=void 0===f||f,p=l.verticalGuidelines,d=l.horizontalGuidelines,h=l.snapThreshold,h=void 0===h?5:h,g=l.snapGridWidth,g=void 0===g?0:g,v=l.snapGridHeight,v=void 0===v?0:v,l=l.maxSnapElementGuidelineDistance,S=void 0===l?1/0:l,l=tt(W(t.state)),M=l.top,C=l.left,w=l.bottom,l=l.right,D={top:M,left:C,bottom:w,right:l,center:(C+l)/2,middle:(M+w)/2},C=Q([],function(t){var e=t.state,n=t.props.elementGuidelines,n=void 0===n?[]:n;if(!n.length)return e.elementRects=[],[];var r=(e.elementRects||[]).filter(function(t){return!t.refresh}),i=n.map(function(t){return ot(t)&&"element"in t?A(A({},t),{element:Jr(t.element,!0)}):{element:Jr(t,!0)}}).filter(function(t){return t.element}),n=function(t,e){return _(t,e,ke)}(r.map(function(t){return t.element}),i.map(function(t){return t.element})),o=n.maintained,a=n.added,s=[],g=(o.forEach(function(t){var e=t[0],t=t[1];s[t]=r[e]}),function(t,e){if(!e.length)return[];var t=t.state,n=t.containerClientRect,r=t.targetClientRect,i=r.top,r=r.left,o=t.rootMatrix,a=t.is3d?4:3,n=function(t,e,n){return t=X(t,[e.clientLeft,e.clientTop],n),[e.left+t[0],e.top+t[1]]}(o,n,a),s=n[0],u=n[1],n=Ne(W(t)),t=n.minX,n=n.minY,t=T([t,n],Lr(o,[r-s,i-u],a)).map(function(t){return t=t,Math.round(t%1==-.5?t-1:t)}),c=t[0],l=t[1];return e.map(function(t){var e=t.element.getBoundingClientRect(),n=e.left-s,r=e.top-u,i=r+e.height,e=n+e.width,n=Lr(o,[n,r],a),r=n[0],n=n[1],e=Lr(o,[e,i],a),i=e[0],e=e[1];return A(A({},t),{rect:{left:r+c,right:i+c,top:n+l,bottom:e+l,center:(r+i)/2+c,middle:(n+e)/2+l}})})}(t,a.map(function(t){return i[t]})).map(function(t,e){s[a[e]]=t}),e.elementRects=s,fi(t.props.elementSnapDirections)),v=[];return s.forEach(function(e){var n=e.element,t=e.top,t=void 0===t?g.top:t,r=e.left,r=void 0===r?g.left:r,i=e.right,i=void 0===i?g.right:i,o=e.bottom,o=void 0===o?g.bottom:o,a=e.center,a=void 0===a?g.center:a,s=e.middle,s=void 0===s?g.middle:s,u=e.className,c=e.rect,t=pi({top:t,right:i,left:r,bottom:o,center:a,middle:s},c),i=t.horizontal,r=t.vertical,l=c.top,f=c.left,p=c.right-f,d=c.bottom-l,h=[p,d];r.forEach(function(t){v.push({type:"vertical",element:n,pos:[N(t,.1),l],size:d,sizes:h,className:u,elementRect:e})}),i.forEach(function(t){v.push({type:"horizontal",element:n,pos:[f,N(t,.1)],size:p,sizes:h,className:u,elementRect:e})})}),v}(t),!0);return f&&C.push.apply(C,(m=D,b=h,l=t.props,M=l.maxSnapElementGuidelineDistance,x=void 0===M?1/0:M,M=l.maxSnapElementGapDistance,E=void 0===M?1/0:M,o=t.state.elementRects,y=[],[["vertical",ui,ci],["horizontal",ci,ui]].forEach(function(t){var p=t[0],d=t[1],a=t[2],h=m[d.start],g=m[d.end],v=m[d.center],n=m[a.start],r=m[a.end];function i(t){t=t.rect;return t[d.end]<h+b?h-t[d.end]:g-b<t[d.start]?t[d.start]-g:-1}var e=o.filter(function(t){var e=t.rect;return!(e[a.start]>r||e[a.end]<n)&&0<i(t)}).sort(function(t,e){return i(t)-i(e)}),s=[];e.forEach(function(o){e.forEach(function(t){var e,n,r,i;o!==t&&(r=o.rect,e=t.rect,n=r[a.start],r=r[a.end],i=e[a.start],e[a.end]<n||r<i||s.push([o,t]))})}),s.forEach(function(t){var e=t[0],t=t[1],n=e.rect,r=t.rect,i=n[d.start],n=n[d.end],o=r[d.start],a=r[d.end],s=0,u=0,c=!1,l=!1,f=!1;if(n<=h&&g<=o){if(l=!0,u=n+(s=(o-n-(g-h))/2)+(g-h)/2,Math.abs(u-v)>b)return}else if(n<o&&a<h+b){if(c=!0,u=a+(s=o-n),Math.abs(u-h)>b)return}else{if(!(n<o&&g-b<i))return;if(f=!0,u=i-(s=o-n),Math.abs(u-g)>b)return}!s||!$i(m,r,p,x)||E<s||y.push({type:p,pos:"vertical"===p?[u,0]:[0,u],element:t.element,size:0,className:t.className,isStart:c,isCenter:l,isEnd:f,gap:s,hide:!0,gapRects:[e,t]})})}),y)),C.push.apply(C,function(t,e,n,r,i,o){void 0===i&&(i=0);void 0===o&&(o=0);var a=[];if(e)for(var s=0;s<=r;s+=e)a.push({type:"horizontal",pos:[0,N(s-o,.1)],size:n,hide:!0});if(t)for(s=0;s<=n;s+=t)a.push({type:"vertical",pos:[N(s-i,.1),0],size:r,hide:!0});return a}(g,v,r?a:u,r?i:s,c,e)),C.push.apply(C,Zi(d||!1,p||!1,r?a:u,r?i:s,c,e,n)),C=C.filter(function(t){var e=t.element,n=t.elementRect,t=t.type;if(!e||!n)return!0;e=n.rect;return $i(D,e,t,S)})}function $i(t,e,n,r){return"horizontal"===n?Math.abs(t.right-e.left)<=r||Math.abs(t.left-e.right)<=r||t.left<=e.right&&e.left<=t.right:"vertical"!==n||(Math.abs(t.bottom-e.top)<=r||Math.abs(t.top-e.bottom)<=r||t.top<=e.bottom&&e.top<=t.bottom)}function Zi(t,e,n,r,i,o,a){void 0===i&&(i=0),void 0===o&&(o=0);var s=[],u=(a=void 0===a?{left:0,top:0,right:0,bottom:0}:a).left,c=a.top,l=a.bottom,f=n+a.right-u,p=r+l-c;return t&&t.forEach(function(t){t=ot(t)?t:{pos:t};s.push({type:"horizontal",pos:[u,N(t.pos-o+c,.1)],size:f,className:t.className})}),e&&e.forEach(function(t){t=ot(t)?t:{pos:t};s.push({type:"vertical",pos:[N(t.pos-i+u,.1),c],size:p,className:t.className})}),s}function Ki(t){var e,n,r,i,o=t.state;o.guidelines&&o.guidelines.length||(r=t.state.container,i=t.props.snapContainer||r,e=o.containerClientRect,n={left:0,top:0,bottom:0,right:0},r!==i&&(r=Jr(i,!0))&&(r=ti(o,[(i=Tr(r)).left-e.left,i.top-e.top]),i=ti(o,[i.right-e.right,i.bottom-e.bottom]),n.left=N(r[0],1e-5),n.top=N(r[1],1e-5),n.right=N(i[0],1e-5),n.bottom=N(i[1],1e-5)),o.snapOffset=n,o.guidelines=Ui(t),o.enableSnap=!0)}function Ji(t,e,n,r,i,o){t=Sr(t,e,n,o?4:3);return kr(t,T(i,j(t,r)))}function Qi(t,e,n,r,i,o){var a,s,u,c,l=o.fixedDirection,l=(a=n,s=l,c=[],r?(1!==Math.abs(s[0])||1!==Math.abs(s[1])?c.push([s,[-1,-1]],[s,[-1,1]],[s,[1,-1]],[s,[1,1]]):c.push([s,[a[0],-a[1]]],[s,[-a[0],a[1]]]),c.push([s,a])):a[0]&&a[1]||!a[0]&&!a[1]?(u=a[0]?a:[1,1],[1,-1].forEach(function(e){[1,-1].forEach(function(t){t=[e*u[0],t*u[1]];s[0]===t[0]&&s[1]===t[1]||c.push([s,t])})})):a[0]?(1===Math.abs(s[0])?[1]:[1,-1]).forEach(function(t){c.push([[s[0],-1],[t*a[0],-1]],[[s[0],0],[t*a[0],0]],[[s[0],1],[t*a[0],1]])}):a[1]&&(1===Math.abs(s[1])?[1]:[1,-1]).forEach(function(t){c.push([[-1,s[1]],[-1,t*a[1]]],[[0,s[1]],[0,t*a[1]]],[[1,s[1]],[1,t*a[1]]])}),c),n=Oi(t,e,n,r),e=Q(Q([],Hi(t,e,l,r,i,o),!0),Di(t,n,o),!0),l=Ei(e,0),r=Ei(e,1);return{width:{isBound:l.isBound,offset:l.offset[0]},height:{isBound:r.isBound,offset:r.offset[1]}}}function to(t,e,n,r,i,o,a,s){for(var u,c,l,f,p,d,h,g,v,m,b,x,E,y,S,M,A,C,w,D=W(t.state),F=t.props.keepRatio,R=0,O=0,_=0;_<2;++_){var P=Qi(t,e(R,O),i,F,a,s),B=P.width,P=P.height,z=B.isBound,T=P.isBound,G=B.offset,k=P.offset;if(1===_&&(z||(G=0),T||(k=0)),0===_&&a&&!z&&!T)return[0,0];F&&(B=Math.abs(G)*(n?1/n:1),P=Math.abs(k)*(r?1/r:1),(z&&T?B<P:T||!z&&B<P)?G=n*k/r:k=r*G/n),R+=G,O+=k}return i[0]&&i[1]&&(h=t,g=D,v=o,m=s,S=[-(D=i)[0],-D[1]],M=(o=h.state).width,A=o.height,o=h.props.bounds,w=C=1/0,o&&(h=[[D[0],-D[1]],[-D[0],D[1]]],D=o.left,b=void 0===D?-1/0:D,D=o.top,x=void 0===D?-1/0:D,D=o.right,E=void 0===D?1/0:D,D=o.bottom,y=void 0===D?1/0:D,h.forEach(function(t){var e,n,r=t[0]!==S[0],i=t[1]!==S[1],t=j(g,t),o=360*I(v,t)/Math.PI;i&&(e=t.slice(),(Math.abs(o-360)<2||Math.abs(o-180)<2)&&(e[1]=v[1]),n=(i=Yi(v,e,(v[1]<t[1]?y:x)-t[1],!1,m)).offset[1],i=i.isOutside,isNaN(n)||(w=A+(i?1:-1)*Math.abs(n))),r&&(e=t.slice(),(Math.abs(o-90)<2||Math.abs(o-270)<2)&&(e[0]=v[0]),n=(i=Yi(v,e,(v[0]<t[0]?E:b)-t[0],!0,m)).offset[0],r=i.isOutside,isNaN(n)||(C=M+(r?1:-1)*Math.abs(n)))})),D=(o={maxWidth:C,maxHeight:w}).maxWidth,h=o.maxHeight,o=t,u=e(R,O).map(function(t){return t.map(function(t){return N(t,Bn)})}),c=n+R,l=r+O,D=D,h=h,p=a,d=s,u=j(u,f=i),p=(o=qi(o,p,{vertical:[u[0]],horizontal:[u[1]]})).horizontal.offset,R+=G=(p=(u=o.vertical.offset)||p?(d=(o=$n({datas:d,distX:-u,distY:-p}))[0],u=o[1],[Math.min(D||1/0,c+f[0]*d)-c,Math.min(h||1/0,l+f[1]*u)-l]):[0,0])[0],O+=k=p[1]),[R,O]}function eo(t,o,e,n,a){if(!li(t,"scalable"))return[0,0];var s=a.startOffsetWidth,u=a.startOffsetHeight,c=a.fixedPosition,l=a.fixedDirection,f=a.is3d,t=to(t,function(t,e){return Ji((n=a,t=J(o,[t/s,e/u]),e=n.transformOrigin,r=n.offsetMatrix,i=n.is3d?4:3,Kn(r,K(n.targetMatrix,Re(t,i),i),e,i)),s,u,l,c,f);var n,r,i},s,u,e,c,n,a);return[t[0]/s,t[1]/u]}function no(t){var e=[];return t.forEach(function(t){t.guidelineInfos.forEach(function(t){t=t.guideline;-1<e.indexOf(t)||e.push(t)})}),e}function ro(t,e,n,r,i,o){o=Bi(zi(t,o),e,n),e=o.vertical,n=o.horizontal,e.forEach(function(t){t.isBound&&r.push({type:"bounds",pos:t.pos})}),n.forEach(function(t){t.isBound&&i.push({type:"bounds",pos:t.pos})}),o=function(t){if(!(n=t.props.innerBounds))return{vertical:[],horizontal:[]};var e=t.getRect(),a=j(e=[e.pos1,e.pos2,e.pos3,e.pos4],[0,0]),s=n.left,u=n.top,c=n.width,l=n.height,f=[[s,u],[s,u+l]],p=[[s,u],[s+c,u]],d=[[s+c,u],[s+c,u+l]],h=[[s,u+l],[s+c,u+l]],n=Oi(t,e,[0,0],!1),g=[],v=[],m={top:!1,bottom:!1,left:!1,right:!1};return n.forEach(function(t){var e=t.line,t=t.lineConstants,n=yi(a,e),r=n.horizontal,n=n.vertical,i=wi(e,t,p,n,1,!0),n=wi(e,t,h,n,1,!0),o=wi(e,t,f,r,1,!0),e=wi(e,t,d,r,1,!0);i.isBound&&!m.top&&(g.push(u),m.top=!0),n.isBound&&!m.bottom&&(g.push(u+l),m.bottom=!0),o.isBound&&!m.left&&(v.push(s),m.left=!0),e.isBound&&!m.right&&(v.push(s+c),m.right=!0)}),{horizontal:g,vertical:v}}(t),e=o.vertical,n=o.horizontal;e.forEach(function(n){0<=mt(r,function(t){var e=t.type,t=t.pos;return"bounds"===e&&t===n})||r.push({type:"bounds",pos:n})}),n.forEach(function(n){0<=mt(i,function(t){var e=t.type,t=t.pos;return"bounds"===e&&t===n})||i.push({type:"bounds",pos:n})})}var io=Zr("",["resizable","scalable"]),t={name:"snappable",dragRelation:"strong",props:{snappable:[Boolean,Array],snapContainer:Object,snapDirections:[Boolean,Object],elementSnapDirections:[Boolean,Object],snapGap:Boolean,snapGridWidth:Number,snapGridHeight:Number,isDisplaySnapDigit:Boolean,isDisplayInnerSnapDigit:Boolean,snapDigit:Number,snapThreshold:Number,horizontalGuidelines:Array,verticalGuidelines:Array,elementGuidelines:Array,bounds:Object,innerBounds:Object,snapDistFormat:Function,maxSnapElementGuidelineDistance:Number,maxSnapElementGapDistance:Number},events:{onSnap:"snap"},css:[":host {\n    --bounds-color: #d66;\n}\n.guideline {\n    pointer-events: none;\n    z-index: 2;\n}\n.guideline.bounds {\n    background: #d66;\n    background: var(--bounds-color);\n}\n.guideline-group {\n    position: absolute;\n    top: 0;\n    left: 0;\n}\n.guideline-group .size-value {\n    position: absolute;\n    color: #f55;\n    font-size: 12px;\n    font-weight: bold;\n}\n.guideline-group.horizontal .size-value {\n    transform-origin: 50% 100%;\n    transform: translateX(-50%);\n    left: 50%;\n    bottom: 5px;\n}\n.guideline-group.vertical .size-value {\n    transform-origin: 0% 50%;\n    top: 50%;\n    transform: translateY(-50%);\n    left: 5px;\n}\n.guideline.gap {\n    background: #f55;\n}\n.size-value.gap {\n    color: #f55;\n}\n"],render:function(t,e){var n=t.state,r=n.top,i=n.left,o=n.pos1,a=n.pos2,s=n.pos3,u=n.pos4,c=n.snapRenderInfo;if(!c||!li(t,""))return[];n.guidelines=Ui(t);var d,h,g,v,m,b,n=Math.min(o[0],a[0],s[0],u[0]),o=Math.min(o[1],a[1],s[1],u[1]),a=c.externalPoses||[],s=W(t.state),l=[],f=[],p=[],x=[],u=[],E=tt(s),y=E.width,S=E.height,M=E.top,C=E.left,w=E.bottom,E=E.right,D={left:C,right:E,top:M,bottom:w,center:(C+E)/2,middle:(M+w)/2},R=0<a.length,a=R?tt(a):{},s=(c.request||(c.direction&&u.push(bi(t,s,c.direction)),c.snap&&(s=tt(s),c.center&&(s.middle=(s.top+s.bottom)/2,s.center=(s.left+s.right)/2),u.push(gi(t,s,1))),R&&(c.center&&(a.middle=(a.top+a.bottom)/2,a.center=(a.left+a.right)/2),u.push(gi(t,a,1))),u.forEach(function(t){var e=t.vertical.posInfos,t=t.horizontal.posInfos;l.push.apply(l,e.filter(function(t){return t.guidelineInfos.some(function(t){return!t.guideline.hide})}).map(function(t){return{type:"snap",pos:t.pos}})),f.push.apply(f,t.filter(function(t){return t.guidelineInfos.some(function(t){return!t.guideline.hide})}).map(function(t){return{type:"snap",pos:t.pos}})),p.push.apply(p,no(e)),x.push.apply(x,no(t))})),ro(t,[C,E],[M,w],l,f),R&&ro(t,[a.left,a.right],[a.top,a.bottom],l,f,c.externalBounds),Q(Q([],p,!0),x,!0)),u=s.filter(function(t){return t.element&&!t.gapRects}),C=s.filter(function(t){return t.gapRects}).sort(function(t,e){return t.gap-e.gap});return nt(t,"onSnap",{guidelines:s.filter(function(t){return!t.element}),elements:u,gaps:C},!0),Q(Q(Q(Q(Q(Q([],ji(t,u,[n,o],D,e),!0),(d=t,h=C,g=[n,o],v=D,m=e,b=[],["horizontal","vertical"].forEach(function(e){var t=h.filter(function(t){return t.type===e}).slice(0,1),o="vertical"===e?0:1,a=o?0:1,s=o?ci:ui,u=o?ui:ci,c=v[s.start],l=v[s.end],f=v[u.start],p=v[u.end];t.forEach(function(t){var r=t.gap,t=t.gapRects,e=Math.max.apply(Math,Q([f],t.map(function(t){return t.rect[u.start]}),!1)),n=Math.min.apply(Math,Q([p],t.map(function(t){return t.rect[u.end]}),!1)),i=(e+n)/2;e!==n&&i!=(f+p)/2&&t.forEach(function(t){var e=t.rect,t=t.className,n=[g[0],g[1]];if(e[s.end]<c)n[o]+=e[s.end]-c;else{if(!(l<e[s.start]))return;n[o]+=e[s.start]-c-r}n[a]+=i-f,b.push(Ni(d,o?"vertical":"horizontal","gap",b.length,r,n,t,m))})})}),b),!0),Ii(t,"horizontal",x,[i,r],D,e),!0),Ii(t,"vertical",p,[i,r],D,e),!0),Fi(t,"horizontal",f,n,r,y,0,e),!0),Fi(t,"vertical",l,o,i,S,1,e),!0)},dragStart:function(t,e){t.state.snapRenderInfo={request:e.isRequest,snap:!0,center:!0},Ki(t)},drag:function(t){t.state.guidelines=Ui(t)},pinchStart:function(t){this.unset(t)},dragEnd:function(t){this.unset(t)},dragControlCondition:function(t,e){return!(!io(t,e)&&!mo(t,e))||(!e.isRequest&&e.inputEvent?P(e.inputEvent.target,G("snap-control")):void 0)},dragControlStart:function(t){t.state.snapRenderInfo=null,Ki(t)},dragControl:function(t){this.drag(t)},dragControlEnd:function(t){this.unset(t)},dragGroupStart:function(t,e){this.dragStart(t,e)},dragGroup:function(t){this.drag(t)},dragGroupEnd:function(t){this.unset(t)},dragGroupControlStart:function(t){t.state.snapRenderInfo=null,Ki(t)},dragGroupControl:function(t){this.drag(t)},dragGroupControlEnd:function(t){this.unset(t)},unset:function(t){t=t.state;t.enableSnap=!1,t.guidelines=[],t.snapRenderInfo=null,t.elementRects=[]}};function oo(t,a,e,s){var n=t.state,u=n.renderPoses,c=n.rotation,n=n.direction,l=_r(t.props,a).zoom,f=0<n?1:-1,p=c/Math.PI*180,d={},n=t.renderState,h=(n.renderDirectionMap||(n.renderDirectionMap={}),n.renderDirectionMap);return e.forEach(function(t){t=t.dir;d[t]=!0}),e.map(function(t){var e=t.data,n=t.classNames,t=t.dir,r=Fn[t];if(!r||!d[t])return null;h[t]=!0;var i=(N(p,15)+f*In[t]+720)%180,o={};return yt(e).forEach(function(t){o["data-".concat(t)]=e[t]}),s.createElement("div",A({className:G.apply(void 0,Q(["control","direction",t,a],n,!1)),"data-rotation":i,"data-direction":t},o,{key:"direction-".concat(t),style:Or.apply(void 0,Q([c,l],r.map(function(t){return u[t]}),!1))}))})}function ao(t,e,n,r){var i=_r(t.props,n).renderDirections,e=void 0===i?e:i;return e?oo(t,n,(!0===e?kn:e).map(function(t){return{data:{},classNames:[],dir:t}}),r):[]}function so(t,e,n,r,i,o){for(var a=[],s=6;s<arguments.length;s++)a[s-6]=arguments[s];var u=I(n,r),c=e?N(u/Math.PI*180,15)%180:-1;return t.createElement("div",{key:"line-".concat(o),className:G.apply(void 0,Q(["line","direction",e?"edge":"",e],a,!1)),"data-rotation":c,"data-line-index":o,"data-direction":e,style:Rr(n,r,i,u)})}function uo(i,o,t,a,s){return(!0===t?Gn:t).map(function(t,e){var n=Fn[t],r=n[0],n=n[1];if(null!=n)return so(i,t,a[r],a[n],s,"".concat(o,"Edge").concat(e),o)}).filter(Boolean)}function co(r){return function(t,e){var n=_r(t.props,r).edge;return n&&(!0===n||n.length)?Q(Q([],uo(e,r,n,t.state.renderPoses,t.props.zoom),!0),ao(t,["nw","ne","sw","se"],r,e),!0):lo(t,r,e)}}function lo(t,e,n){return ao(t,kn,e,n)}var q={name:"draggable",props:{draggable:Boolean,throttleDrag:Number,throttleDragRotate:Number,startDragRotate:Number,edgeDraggable:Boolean},events:{onDragStart:"dragStart",onDrag:"drag",onDragEnd:"dragEnd",onDragGroupStart:"dragGroupStart",onDragGroup:"dragGroup",onDragGroupEnd:"dragGroupEnd"},render:function(t,e){var n=t.props,r=n.throttleDragRotate,n=n.zoom,t=t.state,i=t.dragInfo,t=t.beforeOrigin;if(!r||!i)return[];r=i.dist;if(!r[0]&&!r[1])return[];i=wr(r),r=I(r,[0,0]);return[e.createElement("div",{className:G("line","horizontal","dragline","dashed"),key:"dragRotateGuideline",style:{width:"".concat(i,"px"),transform:"translate(".concat(t[0],"px, ").concat(t[1],"px) rotate(").concat(r,"rad) scaleY(").concat(n,")")}})]},dragStart:function(t,e){var n=e.datas,r=e.parentEvent,i=e.parentGesto,o=t.state,a=o.target,o=o.gestos;if(o.draggable)return!1;o.draggable=i||t.targetGesto;i=jr(a),n.datas={},n.left=parseFloat(i.left||"")||0,n.top=parseFloat(i.top||"")||0,n.bottom=parseFloat(i.bottom||"")||0,n.right=parseFloat(i.right||"")||0,n.startValue=[0,0],Wn(t,e),Qn(e,"translate"),n.absolutePoses=W(t.state),n.prevDist=[0,0],n.prevBeforeDist=[0,0],n.isDrag=!1,n.deltaOffset=[0,0],a=et(t,e,A({set:function(t){n.startValue=t}},Jn(e)));return!1!==(r||nt(t,"onDragStart",a))?(n.isDrag=!0,t.state.dragInfo={startRect:t.getRect(),dist:[0,0]}):(o.draggable=null,n.isPinch=!1),!!n.isDrag&&a},drag:function(t,e){if(e){qn(e,"translate");var n=e.datas,r=e.parentEvent,i=e.parentFlag,o=e.isPinch,a=e.isRequest,s=e.deltaOffset,u=e.distX,c=e.distY,l=n.isDrag,f=n.prevDist,p=n.prevBeforeDist,d=n.startValue;if(l){s&&(u+=s[0],c+=s[1]);var l=t.props,h=l.parentMoveable,g=!r&&l.throttleDrag||0,v=!r&&l.throttleDragRotate||0,m=!1,b=0,i=(!r&&0<v&&(u||c)&&(l=N((l=l.startDragRotate||0)+180*I([0,0],[u,c])/Math.PI,v)-l,x=c*Math.abs(Math.cos((l-90)/180*Math.PI)),x=wr([u*Math.abs(Math.cos(l/180*Math.PI)),x]),b=l*Math.PI/180,u=x*Math.cos(b),c=x*Math.sin(b)),o||r||i||v&&!u&&!c||(x=(l=Wi(t,u,c,v,a||s,n))[0],b=l[1],i=x.isSnap,a=x.isBound,s=x.offset,l=b.isSnap,x=b.isBound,m=i||l||a||x,u+=s,c+=b.offset),J(Un({datas:n,distX:u,distY:c}),d)),l=J(Hn({datas:n,distX:u,distY:c}),d),a=(v||m||(Dt(l,g),Dt(i,g)),Dt(l,F),Dt(i,F),T(i,d)),x=T(l,d),s=T(x,f),b=T(a,p),u=(n.prevDist=x,n.prevBeforeDist=a,n.passDelta=s,n.passDist=x,n.left+a[0]),c=n.top+a[1],v=n.right-a[0],m=n.bottom-a[1],g=Ln(n,"translate(".concat(l[0],"px, ").concat(l[1],"px)"),"translate(".concat(x[0],"px, ").concat(x[1],"px)"));if(er(e,g),t.state.dragInfo.dist=r?[0,0]:x,r||h||!s.every(function(t){return!t})||!b.some(function(t){return!t}))return f=(d=t.state).width,p=d.height,n=et(t,e,A({transform:g,dist:x,delta:s,translate:l,beforeDist:a,beforeDelta:b,beforeTranslate:i,left:u,top:c,right:v,bottom:m,width:f,height:p,isPinch:o},Fr({transform:g},e))),r||nt(t,"onDrag",n),n}}},dragAfter:function(t,e){var n=e.datas,r=n.deltaOffset;return!(!r[0]&&!r[1])&&(n.deltaOffset=[0,0],this.drag(t,A(A({},e),{deltaOffset:r})))},dragEnd:function(t,e){var n=e.parentEvent,r=e.datas;if(t.state.dragInfo=null,r.isDrag)return r.isDrag=!1,r=y(t,e,{}),n||nt(t,"onDragEnd",r),r},dragGroupStart:function(t,e){var n=e.datas,r=e.clientX,i=e.clientY,o=this.dragStart(t,e);if(!o)return!1;r=ii(t,this,"dragStart",[r||0,i||0],e,!1,"draggable"),i=nt(t,"onDragGroupStart",A(A({},o),{targets:t.props.targets,events:r}));return n.isDrag=!1!==i,!!n.isDrag&&o},dragGroup:function(t,e){if(e.datas.isDrag){var n=this.drag(t,e),e=ii(t,this,"drag",e.datas.passDelta,e,!1,"draggable");if(n)return nt(t,"onDragGroup",t=A({targets:t.props.targets,events:e},n)),t}},dragGroupEnd:function(t,e){var n,r=e.isDrag;if(e.datas.isDrag)return this.dragEnd(t,e),n=ii(t,this,"dragEnd",[0,0],e,!1,"draggable"),nt(t,"onDragGroupEnd",y(t,e,{targets:t.props.targets,events:n})),r},request:function(t){var e={},n=t.getRect(),r=0,i=0;return{isControl:!1,requestStart:function(){return{datas:e}},request:function(t){return"x"in t?r=t.x-n.left:"deltaX"in t&&(r+=t.deltaX),"y"in t?i=t.y-n.top:"deltaY"in t&&(i+=t.deltaY),{datas:e,distX:r,distY:i}},requestEnd:function(){return{datas:e,isDrag:!0}}}},unset:function(t){t.state.gestos.draggable=null,t.state.dragInfo=null}},d=Zr("resizable"),fo={name:"resizable",ableGroup:"size",canPinch:!0,props:{resizable:Boolean,throttleResize:Number,renderDirections:Array,keepRatio:Boolean,resizeFormat:Function,keepRatioFinally:Boolean,edge:Boolean},events:{onResizeStart:"resizeStart",onBeforeResize:"beforeResize",onResize:"resize",onResizeEnd:"resizeEnd",onResizeGroupStart:"resizeGroupStart",onBeforeResizeGroup:"beforeResizeGroup",onResizeGroup:"resizeGroup",onResizeGroupEnd:"resizeGroupEnd"},render:co("resizable"),dragControlCondition:d,dragControlStart:function(t,e){var n=e.inputEvent,r=e.isPinch,i=e.isGroup,o=e.parentDirection,a=e.parentGesto,s=e.datas,u=e.parentFixedDirection,c=e.parentEvent,o=o||(r?[0,0]:Gr(n.target)),n=t.state,l=n.target,f=n.width,p=n.height,d=n.gestos;if(!o||!l)return!1;if(d.resizable)return!1;d.resizable=a||t.controlGesto,r||Wn(t,e),s.datas={},s.direction=o,s.startOffsetWidth=f,s.startOffsetHeight=p,s.prevWidth=0,s.prevHeight=0,s.minSize=[0,0],s.startWidth=n.cssWidth,s.startHeight=n.cssHeight,s.maxSize=[1/0,1/0],i||(s.minSize=[n.minOffsetWidth,n.minOffsetHeight],s.maxSize=[n.maxOffsetWidth,n.maxOffsetHeight]);l=t.props.transformOrigin||"% %";function h(t){s.ratio=t&&isFinite(t)?t:0}function g(t){s.fixedDirection=t,s.fixedPosition=j(s.startPositions,t)}function v(t){s.minSize=[Z("".concat(t[0]),0)||0,Z("".concat(t[1]),0)||0]}function m(t){t=[t[0]||1/0,t[1]||1/0];at(t[0])&&!isFinite(t[0])||(t[0]=Z("".concat(t[0]),0)||1/0),at(t[1])&&!isFinite(t[1])||(t[1]=Z("".concat(t[1]),0)||1/0),s.maxSize=t}s.transformOrigin=l&&b(l)?l.split(" "):l,s.startOffsetMatrix=n.offsetMatrix,s.startTransformOrigin=n.transformOrigin,s.isWidth=null!=(d=null==e?void 0:e.parentIsWidth)?d:!o[0]&&!o[1]||o[0]||!o[1],s.startPositions=W(t.state),h(f/p),g(u||[-o[0],-o[1]]),s.setFixedDirection=g,s.setMin=v,s.setMax=m;a=et(t,e,{direction:o,startRatio:s.ratio,set:function(t){var e=t[0],t=t[1];s.startWidth=e,s.startHeight=t},setMin:v,setMax:m,setRatio:h,setFixedDirection:g,setOrigin:function(t){s.transformOrigin=t},dragStart:q.dragStart(t,(new Yn).dragStart([0,0],e))}),r=c||nt(t,"onResizeStart",a);return s.startFixedDirection=s.fixedDirection,!1!==r&&(s.isResize=!0,t.state.snapRenderInfo={request:e.isRequest,direction:o}),!!s.isResize&&a},dragControl:function(t,n){var r=n.datas,e=n.parentFlag,i=n.isPinch,o=n.parentKeepRatio,a=n.dragClient,s=n.parentDist,u=n.isRequest,c=n.isGroup,l=n.parentEvent,f=n.resolveMatrix,p=r.isResize,d=r.transformOrigin,h=r.startWidth,g=r.startHeight,v=r.prevWidth,m=r.prevHeight,b=r.minSize,x=r.maxSize,E=r.ratio,y=r.startOffsetWidth,S=r.startOffsetHeight,M=r.isWidth;if(p){f&&(p=t.state.is3d,f=r.startOffsetMatrix,w=r.startTransformOrigin,p=p?4:3,R=Pe(rr(n)),w=Sr(f=Kn(f,R=p!==(f=Math.sqrt(R.length))?ve(R,f,p):R,w,p),y,S,p),r.startPositions=w,r.nextTargetMatrix=R,r.nextAllMatrix=f);var p=_r(t.props,"resizable"),C=p.resizeFormat,w=p.throttleResize,D=void 0===w?e?0:1:w,R=p.parentMoveable,f=p.keepRatioFinally,w=r.direction,O=w,_=0,P=0,B=(w[0]||w[1]||(O=[1,1]),E&&(null!=o?o:p.keepRatio)||!1),o=G(),z=o[0],T=o[1],p=(l||(r.setFixedDirection(r.fixedDirection),nt(t,"onBeforeResize",et(t,n,{startFixedDirection:r.startFixedDirection,setFixedDirection:function(t){return r.setFixedDirection(t),t=G(),z=t[0],T=t[1],[z,T]},boundingWidth:z,boundingHeight:T,setSize:function(t){z=t[0],T=t[1]}},!0))),a),o=(a||(p=!e&&i?lr(t,[0,0]):r.fixedPosition),[0,0]),u=(i||(o=function(t,n,r,e,i,o,a){if(!li(t,"resizable"))return[0,0];var s=a.fixedDirection,u=a.nextAllMatrix,c=t.state,l=c.allMatrix,f=c.is3d;return to(t,function(t,e){return Ji(u||l,n+t,r+e,s,i,f)},n,r,e,i,o,a)}(t,z,T,w,p,u,r)),s&&(s[0]||(o[0]=0),s[1]||(o[1]=0)),B?(O[0]&&O[1]&&o[0]&&o[1]&&(Math.abs(o[0])>Math.abs(o[1])?o[1]=0:o[0]=0),(a=!o[0]&&!o[1])&&k(),O[0]&&!O[1]||o[0]&&!o[1]||a&&M?(z+=o[0],T=z/E):(!O[0]&&O[1]||!o[0]&&o[1]||a&&!M)&&(T+=o[1],z=T*E)):(z+=o[0],T+=o[1],z=Math.max(0,z),T=Math.max(0,T)),e=function(t,n,r,e){if(!e)return t.map(function(t,e){return St(t,n[e],r[e])});var i=t[0],o=t[1],a=(s=Mt(t,n,!1,e=!0===e?i/o:e))[0],s=s[1],e=(t=Mt(t,r,!0,e))[0],t=t[1];return i<a||o<s?(i=a,o=s):(e<i||t<o)&&(i=e,o=t),[i,o]}([z,T],b,x,!!B&&E),z=e[0],T=e[1],k(),B&&(c||f)&&(M?T=z/E:z=T*E),[(_=z-y)-v,(P=T-S)-m]),s=(r.prevWidth=_,r.prevHeight=P,cr(t,z,T,p,d,r));if(R||!u.every(function(t){return!t})||!s.every(function(t){return!t}))return o=(a=q.drag(t,jn(n,t.state,s,!!i,!1,"draggable"))).transform,e=et(t,n,A({width:b=h+_,height:x=g+P,offsetWidth:Math.round(z),offsetHeight:Math.round(T),startRatio:E,boundingWidth:z,boundingHeight:T,direction:w,dist:[_,P],delta:u,isPinch:!!i,drag:a},Ir({style:{width:"".concat(b,"px"),height:"".concat(x,"px")},transform:o},a,n))),l||nt(t,"onResize",e),e}function G(){var t=r.fixedDirection,e=ni(O,B,r,n),e=(_=e.distWidth,P=e.distHeight,O[0]-t[0]||B?Math.max(y+_,F):y),t=O[1]-t[1]||B?Math.max(S+P,F):S;return B&&y&&S&&(M?t=e/E:e=t*E),[e,t]}function k(){var t;C&&(t=C([z,T]),z=t[0],T=t[1]),z=N(z,D),T=N(T,D)}},dragControlAfter:function(t,e){var n=e.datas,r=n.isResize,i=n.startOffsetWidth,o=n.startOffsetHeight,a=n.prevWidth,s=n.prevHeight;if(r)return r=t.state,i=r.width-(i+a),a=r.height-(o+s),r=3<Math.abs(i),o=3<Math.abs(a),r&&(n.startWidth+=i,n.startOffsetWidth+=i,n.prevWidth+=i),o&&(n.startHeight+=a,n.startOffsetHeight+=a,n.prevHeight+=a),r||o?this.dragControl(t,e):void 0},dragControlEnd:function(t,e){var n=e.datas,r=e.parentEvent;if(n.isResize)return n.isResize=!1,n=y(t,e,{}),r||nt(t,"onResizeEnd",n),n},dragGroupControlCondition:d,dragGroupControlStart:function(i,t){var o=t.datas,e=this.dragControlStart(i,A(A({},t),{isGroup:!0}));if(!e)return!1;var a=ri(i,"resizable",t);function r(t,e){var n=o.fixedDirection,r=o.fixedPosition,t=j(e.datas.startPositions||W(t.state),n),n=B(De(-i.rotation/180*Math.PI,3),[t[0]-r[0],t[1]-r[1],1],3),t=n[0],r=n[1];return e.datas.originalX=t,e.datas.originalY=r,e}var s=o.startOffsetWidth,u=o.startOffsetHeight;function n(){var r=o.minSize;a.forEach(function(t){var t=t.datas,e=t.minSize,n=t.startOffsetWidth,t=t.startOffsetHeight,n=s*(n?e[0]/n:0),e=u*(t?e[1]/t:0);r[0]=Math.max(r[0],n),r[1]=Math.max(r[1],e)})}function c(){var r=o.maxSize;a.forEach(function(t){var t=t.datas,e=t.maxSize,n=t.startOffsetWidth,t=t.startOffsetHeight,n=s*(n?e[0]/n:0),e=u*(t?e[1]/t:0);r[0]=Math.min(r[0],n),r[1]=Math.min(r[1],e)})}function l(n){e.setFixedDirection(n),f.forEach(function(t,e){t.setFixedDirection(n),r(t.moveable,a[e])})}var f=oi(i,this,"dragControlStart",t,r),t=(n(),c(),o.setFixedDirection=l,A(A({},e),{targets:i.props.targets,events:f.map(function(e){return A(A({},e),{setMin:function(t){e.setMin(t),n()},setMax:function(t){e.setMax(t),c()}})}),setFixedDirection:l,setMin:function(t){e.setMin(t),n()},setMax:function(t){e.setMax(t),c()}})),t=nt(i,"onResizeGroupStart",t);return o.isResize=!1!==t,!!o.isResize&&e},dragGroupControl:function(i,e){var t=e.datas;if(t.isResize){var n,o,a,s,r,u,c=_r(i.props,"resizable"),l=(Nr(i,"onBeforeResize",function(t){nt(i,"onBeforeResizeGroup",et(i,e,A(A({},t),{targets:c.targets}),!0))}),this.dragControl(i,A(A({},e),{isGroup:!0})));if(l)return r=l.boundingWidth,u=l.boundingHeight,n=l.dist,o=c.keepRatio,a=[r/(r-n[0]),u/(u-n[1])],s=t.fixedPosition,r=oi(i,this,"dragControl",e,function(t,e){var n=B(De(i.rotation/180*Math.PI,3),[e.datas.originalX*a[0],e.datas.originalY*a[1],1],3),r=n[0],n=n[1];return A(A({},e),{parentDist:null,parentScale:a,dragClient:J(s,[r,n]),parentKeepRatio:o})}),u=A({targets:c.targets,events:r},l),nt(i,"onResizeGroup",u),u}},dragGroupControlEnd:function(t,e){var n,r=e.isDrag;if(e.datas.isResize)return this.dragControlEnd(t,e),n=oi(t,this,"dragControlEnd",e),nt(t,"onResizeGroupEnd",y(t,e,{targets:t.props.targets,events:n})),r},request:function(t){var e={},n=0,r=0,i=t.getRect();return{isControl:!0,requestStart:function(t){return{datas:e,parentDirection:t.direction||[1,1],parentIsWidth:null==(t=null==t?void 0:t.horizontal)||t}},request:function(t){return"offsetWidth"in t?n=t.offsetWidth-i.offsetWidth:"deltaWidth"in t&&(n+=t.deltaWidth),"offsetHeight"in t?r=t.offsetHeight-i.offsetHeight:"deltaHeight"in t&&(r+=t.deltaHeight),{datas:e,parentDist:[n,r],parentKeepRatio:t.keepRatio}},requestEnd:function(){return{datas:e,isDrag:!0}}}},unset:function(t){t.state.gestos.resizable=null}};function po(t,e,n,r,i){var o=t.props.groupable,a=t.state,s=a.is3d?4:3,u=e.origin,t=X(t.state.rootMatrix,T([u[0],u[1]],o?[0,0]:[a.left,a.top]),s),u=J([i.left,i.top],t);e.startAbsoluteOrigin=u,e.prevDeg=I(u,[n,r])/Math.PI*180,e.defaultDeg=e.prevDeg,e.prevSnapDeg=0,e.loop=0,e.startDist=C(u,[n,r])}function ho(t,e,n){var r=n.defaultDeg,i=n.prevDeg,o=i%360,i=Math.floor(i/360),o=(o<0&&(o+=360),t<o&&270<o&&t<90?++i:o<t&&o<90&&270<t&&--i,e*(360*i+t-r));return n.prevDeg=r+o,o}function go(t,e,n,r){return ho(I(r.startAbsoluteOrigin,[t,e])/Math.PI*180,n,r)}function vo(t,e,n,r,i,o){var a=t.props.throttleRotate,a=void 0===a?0:a,s=n.prevSnapDeg,u=0,c=!1,t=(o&&(c=(o=function(t,e,n){if(!li(t,"rotatable"))return{isSnap:!1,rotation:n};var r=e.pos1,i=e.pos2,o=e.pos3,a=e.pos4,s=e.origin,u=n*Math.PI/180,r=(e=[r,i,o,a].map(function(t){return T(t,s)})).map(function(t){return Me(t,u)});return(i=Q(Q([],ki(t,e,r,s,n),!0),Pi(t,e,r,s,n),!0)).sort(function(t,e){return Math.abs(t-n)-Math.abs(e-n)}),{isSnap:o=0<i.length,rotation:o?i[0]:n}}(t,e,r)).isSnap,u=i+o.rotation),(u=c?u:N(i+r,a))-i);return[(n.prevSnapDeg=t)-s,t,u]}function mo(t,e){if(e.isRequest)return"rotatable"===e.requestAble;var n=e.inputEvent.target;if(P(n,G("rotation-control"))||P(n,G("around-control"))||P(n,G("control"))&&P(n,G("rotatable")))return!0;e=t.props.rotationTarget;return!!e&&Qr(e,!0).some(function(t){return!!t&&(n===t||n.contains(t))})}var bo=kn.map(function(t){var e="",n="",r="center",i="center";return-1<t.indexOf("n")&&(e="top: -20px;",i="bottom"),-1<t.indexOf("s")&&(e="top: 0px;",i="top"),-1<t.indexOf("w")&&(n="left: -20px;",r="right"),-1<t.indexOf("e")&&(n="left: 0px;",r="left"),'.around-control[data-direction*="'.concat(t,'"] {\n        ').concat(n).concat(e,"\n        transform-origin: ").concat(r," ").concat(i,";\n    }")}).join("\n"),o=".rotation {\n    position: absolute;\n    height: 40px;\n    width: 1px;\n    transform-origin: 50% 100%;\n    height: calc(40px * var(--zoom));\n    top: auto;\n    left: 0;\n    bottom: 100%;\n    will-change: transform;\n}\n.rotation .rotation-line {\n    display: block;\n    width: 100%;\n    height: 100%;\n    transform-origin: 50% 50%;\n}\n.rotation .rotation-control {\n    border-color: #4af;\n    border-color: var(--moveable-color);\n    background:#fff;\n    cursor: alias;\n}\n.rotatable.direction.control {\n    cursor: alias;\n}\n.around-control {\n    position: absolute;\n    will-change: transform;\n    width: 20px;\n    height: 20px;\n    left: -10px;\n    top: -10px;\n    box-sizing: border-box;\n    background: transparent;\n    z-index: 8;\n    cursor: alias;\n    transform-origin: center center;\n}\n.rotatable.direction.control.move {\n    cursor: move;\n}\n".concat(bo,"\n"),se={name:"rotatable",canPinch:!0,props:{rotatable:Boolean,rotationPosition:String,throttleRotate:Number,renderDirections:Object,rotationTarget:Object,rotateAroundControls:Boolean,edge:Boolean,resolveAblesWithRotatable:Object},events:{onRotateStart:"rotateStart",onBeforeRotate:"beforeRotate",onRotate:"rotate",onRotateEnd:"rotateEnd",onRotateGroupStart:"rotateGroupStart",onBeforeRotateGroup:"beforeRotateGroup",onRotateGroup:"rotateGroup",onRotateGroupEnd:"rotateGroupEnd"},css:[o],render:function(t,e){var n=_r(t.props,"rotatable"),r=n.rotatable,i=n.rotationPosition,o=n.zoom,a=n.renderDirections,s=n.rotateAroundControls,u=n.resolveAblesWithRotatable,n=t.state,c=n.renderPoses,n=n.direction;if(!r)return null;var l,f,p,d,h,g,v,r=function(t,e,n){var r,i,o=e[0],a=e[1],s=e[2],e=e[3];if("none"!==t)return t=(t||"top").split("-"),r=t[0],t=t[1],i=[o,a],"left"===r?i=[s,o]:"right"===r?i=[a,e]:"bottom"===r&&(i=[e,s]),o=[(i[0][0]+i[1][0])/2,(i[0][1]+i[1][1])/2],a=Br(i,n),t&&(e="bottom"===r||"left"===r,o=i[(s="top"===t||"left"===t)&&!e||!s&&e?0:1]),[o,a]}(i,c,n),i=[];return r&&(c=r[0],n=r[1],i.push(e.createElement("div",{key:"rotation",className:G("rotation"),style:{transform:"translate(-50%) translate(".concat(c[0],"px, ").concat(c[1],"px) rotate(").concat(n,"rad)")}},e.createElement("div",{className:G("line rotation-line"),style:{transform:"scaleX(".concat(o,")")}}),e.createElement("div",{className:G("control rotation-control"),style:{transform:"translate(0.5px) scale(".concat(o,")")}})))),a&&(r=yt(u||{}),l={},r.forEach(function(e){u[e].forEach(function(t){l[t]=e})}),c=[],D(a)&&(c=a.map(function(t){var e=l[t];return{data:e?{resolve:e}:{},classNames:e?["move"]:[],dir:t}})),i.push.apply(i,oo(t,"rotatable",c,e))),s&&i.push.apply(i,(f=e,(o=(n=t).renderState).renderDirectionMap||(o.renderDirectionMap={}),p=(r=n.state).renderPoses,d=r.rotation,r=r.direction,o=o.renderDirectionMap,h=n.props.zoom,g=0<r?1:-1,v=d/Math.PI*180,yt(o).map(function(t){var e=Fn[t];if(!e)return null;var n=(N(v,15)+g*In[t]+720)%180;return f.createElement("div",{className:G("around-control"),"data-rotation":n,"data-direction":t,key:"direction-around-".concat(t),style:Or.apply(void 0,Q([d,h],e.map(function(t){return p[t]}),!1))})}))),i},dragControlCondition:mo,dragControlStart:function(o,t){var a=t.datas,e=t.clientX,n=t.clientY,r=t.parentRotate,i=t.parentFlag,s=t.isPinch,u=t.isRequest,c=o.state,l=c.target,f=c.left,p=c.top,d=c.direction,h=c.beforeDirection,g=c.targetTransform,v=c.moveableClientRect,m=c.offsetMatrix,b=c.targetMatrix,x=c.allMatrix,E=c.width,y=c.height;if(!u&&!l)return!1;var S,M,C,w,D,l=o.getRect(),g=(a.rect=l,a.transform=g,a.left=f,a.top=p,function(t){a.fixedDirection=t,a.fixedPosition=ur(o,t),_&&_.setFixedDirection(t)}),R=e,O=n,p=(u||s||i?(a.beforeInfo={origin:l.beforeOrigin,prevDeg:f=r||0,defaultDeg:f,prevSnapDeg:0,startDist:0},a.afterInfo=A(A({},a.beforeInfo),{origin:l.origin}),a.absoluteInfo=A(A({},a.beforeInfo),{origin:l.origin,startValue:f})):((e=null==(p=t.inputEvent)?void 0:p.target)&&(n=e.getAttribute("data-direction")||"",(u=An[n])&&(a.isControl=!0,a.isAroundControl=P(e,G("around-control")),a.controlDirection=u,(s=e.getAttribute("data-resolve"))&&(a.resolveAble=s),M=c.rootMatrix,i=c.renderPoses,r=v,C=16===M.length?4:3,i=i.map(function(t){return X(M,t,C)}),w=r.left,D=r.top,R=(f=j(i.map(function(t){return[t[0]+w,t[1]+D]}),u))[0],O=f[1])),a.beforeInfo={origin:l.beforeOrigin},a.afterInfo={origin:l.origin},a.absoluteInfo={origin:l.origin,startValue:l.rotation},S=g,g=function(t){var e=c.is3d?4:3,n=j([[0,0],[E,0],[0,y],[E,y]],t),r=J(he(b,e),n),i=r[0],r=r[1],i=B(m,ge([i,r],e)),r=B(x,ge([n[0],n[1]],e));S(t),a.beforeInfo.origin=i,a.afterInfo.origin=r,a.absoluteInfo.origin=r,po(o,a.beforeInfo,R,O,v),po(o,a.afterInfo,R,O,v),po(o,a.absoluteInfo,R,O,v)}),a.startClientX=R,a.startClientY=O,a.direction=d,a.beforeDirection=h,a.startValue=0,a.datas={},Qn(t,"rotate"),!1),_=!1,r=((_=a.isControl&&a.resolveAble&&"resizable"===a.resolveAble?fo.dragControlStart(o,A(A({},new Yn("resizable").dragStart([0,0],t)),{parentDirection:a.controlDirection,parentFixedDirection:a.fixedDirection})):_)||(p=q.dragStart(o,(new Yn).dragStart([0,0],t))),g((e=(n=(n=o).state).width,s=n.height,[(n=n.transformOrigin)[0]/(e/2)-1,n[1]/(s/2)-1])),et(o,t,A(A({set:function(t){a.startValue=t*Math.PI/180},setFixedDirection:g},Jn(t)),{dragStart:p,resizeStart:_}))),i=nt(o,"onRotateStart",r);return a.isRotate=!1!==i,c.snapRenderInfo={request:t.isRequest},!!a.isRotate&&r},dragControl:function(t,e){var n=e.datas,r=e.distX,i=e.distY,o=e.parentRotate,a=e.parentFlag,s=e.isPinch,u=e.groupDelta,c=n.beforeDirection,l=n.beforeInfo,f=n.afterInfo,p=n.absoluteInfo,d=n.isRotate,h=n.startValue,g=n.rect,v=n.startClientX,m=n.startClientY;if(d){qn(e,"rotate");var b,x,E,d=c*Cr(e.datas.beforeTransform,[50,50],100,100).direction,y=t.props.parentMoveable,S=180/Math.PI*h,h=p.startValue,M=!1,v=v+r,r=m+i;if(!a&&"parentDist"in e?(m=e.parentDist,E=x=b=m):s||a?(b=ho(o,c,l),x=ho(o,d,f),E=ho(o,d,p)):(b=go(v,r,c,l),x=go(v,r,d,f),E=go(v,r,d,p),M=!0),nt(t,"onBeforeRotate",et(t,e,{beforeRotation:S+b,rotation:S+x,absoluteRotation:h+E,setRotation:function(t){E=b=x=t-S}},!0)),m=(i=vo(t,g,l,b,S,M))[0],b=i[1],a=i[2],c=(o=vo(t,g,f,x,S,M))[0],x=o[1],d=o[2],i=(l=vo(t,g,p,E,h,M))[0],E=l[1],f=l[2],i||c||m||y)return o=Ln(n,"rotate(".concat(d,"deg)"),"rotate(".concat(x,"deg)")),g=x,M=(h=n).fixedDirection,l=h.fixedPosition,u=T(J(u||[0,0],y=sr(t,"rotate(".concat(g,"deg)"),M,l,h)),n.prevInverseDist||[0,0]),n.prevInverseDist=y,n.requestValue=null,M=g=ar(t,o,u,s,e),l=C([v,r],p.startAbsoluteOrigin)-p.startDist,h=void 0,"resizable"===n.resolveAble&&(y=fo.dragControl(t,A(A({},jn(e,t.state,[e.deltaX,e.deltaY],!!s,!1,"resizable")),{resolveMatrix:!0,parentDistance:l})))&&(M=Ir(M,h=y,e)),nt(t,"onRotate",o=et(t,e,A(A({delta:c,dist:x,rotate:d,rotation:d,beforeDist:b,beforeDelta:m,beforeRotate:a,beforeRotation:a,absoluteDist:E,absoluteDelta:i,absoluteRotate:f,absoluteRotation:f,isPinch:!!s,resize:h},g),M))),o}},dragControlAfter:function(t,e){e.datas.requestValue},dragControlEnd:function(t,e){var n=e.datas;if(n.isRotate)return n.isRotate=!1,n=y(t,e,{}),nt(t,"onRotateEnd",n),n},dragGroupControlCondition:mo,dragGroupControlStart:function(t,e){var n=e.datas,r=t.state,i=r.left,o=r.top,a=r.beforeOrigin,r=this.dragControlStart(t,e);if(!r)return!1;r.set(n.beforeDirection*t.rotation);e=oi(t,this,"dragControlStart",e,function(t,e){var t=t.state,n=t.left,r=t.top,t=t.beforeOrigin,n=J(T([n,r],[i,o]),T(t,a));return e.datas.startGroupClient=n,e.datas.groupClient=n,A(A({},e),{parentRotate:0})}),t=nt(t,"onRotateGroupStart",A(A({},r),{targets:t.props.targets,events:e}));return n.isRotate=!1!==t,!!n.isRotate&&r},dragGroupControl:function(e,n){var t=n.datas;if(t.isRotate){Nr(e,"onBeforeRotate",function(t){nt(e,"onBeforeRotateGroup",et(e,n,A(A({},t),{targets:e.props.targets}),!0))});var a,s,u,r=this.dragControl(e,n);if(r)return a=t.beforeDirection,s=r.beforeDist,u=s/180*Math.PI,t=oi(e,this,"dragControl",n,function(t,e){var n=e.datas.startGroupClient,r=e.datas.groupClient,i=r[0],r=r[1],n=Me(n,u*a),o=n[0],n=n[1],i=[o-i,n-r];return e.datas.groupClient=[o,n],A(A({},e),{parentRotate:s,groupDelta:i})}),e.rotation=a*r.beforeRotation,t=A({targets:e.props.targets,events:t,set:function(t){e.rotation=t},setGroupRotation:function(t){e.rotation=t}},r),nt(e,"onRotateGroup",t),t}},dragGroupControlEnd:function(t,e){var n,r=e.isDrag;if(e.datas.isRotate)return this.dragControlEnd(t,e),n=oi(t,this,"dragControlEnd",e),nt(t,"onRotateGroupEnd",y(t,e,{targets:t.props.targets,events:n})),r},request:function(t){var e={},n=0,r=t.getRotation();return{isControl:!0,requestStart:function(){return{datas:e}},request:function(t){return"deltaRotate"in t?n+=t.deltaRotate:"rotate"in t&&(n=t.rotate-r),{datas:e,parentDist:n}},requestEnd:function(){return{datas:e,isDrag:!0}}}}},le=Zr("scalable"),d={name:"scalable",ableGroup:"size",canPinch:!0,props:{scalable:Boolean,throttleScale:Number,renderDirections:String,keepRatio:Boolean,edge:Boolean},events:{onScaleStart:"scaleStart",onBeforeScale:"beforeScale",onScale:"scale",onScaleEnd:"scaleEnd",onScaleGroupStart:"scaleGroupStart",onBeforeScaleGroup:"beforeScaleGroup",onScaleGroup:"scaleGroup",onScaleGroupEnd:"scaleGroupEnd"},render:co("scalable"),dragControlCondition:le,dragControlStart:function(t,e){var n=e.datas,r=e.isPinch,i=e.inputEvent,i=e.parentDirection||(r?[0,0]:Gr(i.target)),o=t.state,a=o.width,s=o.height,u=o.targetTransform,c=o.target,l=o.pos1,f=o.pos2,o=o.pos4;if(!i||!c)return!1;r||Wn(t,e),n.datas={},n.transform=u,n.prevDist=[1,1],n.direction=i,n.startOffsetWidth=a,n.startOffsetHeight=s,n.startValue=[1,1];c=C(l,f),r=C(f,o),u=!i[0]&&!i[1]||i[0]||!i[1];function p(t){n.ratio=t&&isFinite(t)?t:0}function d(t){n.fixedDirection=t,n.fixedPosition=j(n.startPositions,t)}n.scaleWidth=c,n.scaleHeight=r,n.scaleXRatio=c/a,n.scaleYRatio=r/s,Qn(e,"scale"),n.isWidth=u,n.startPositions=W(t.state),n.setFixedDirection=d,p(C(l,f)/C(f,o)),d([-i[0],-i[1]]);c=et(t,e,A(A({direction:i,set:function(t){n.startValue=t},setRatio:p,setFixedDirection:d},Jn(e)),{dragStart:q.dragStart(t,(new Yn).dragStart([0,0],e))})),a=nt(t,"onScaleStart",c);return n.startFixedDirection=n.fixedDirection,!1!==a&&(n.isScale=!0,t.state.snapRenderInfo={request:e.isRequest,direction:i}),!!n.isScale&&c},dragControl:function(t,n){qn(n,"scale");var r=n.datas,e=n.parentKeepRatio,i=n.parentFlag,o=n.isPinch,a=n.dragClient,s=n.isRequest,u=r.prevDist,c=r.direction,l=r.startOffsetWidth,f=r.startOffsetHeight,p=r.isScale,d=r.startValue,h=r.isWidth,g=r.ratio;if(!p)return!1;var p=t.props,v=p.throttleScale,m=p.parentMoveable,b=c,x=(c[0]||c[1]||(b=[1,1]),g&&(null!=e?e:p.keepRatio)||!1),e=t.state;function E(){var t=ni(b,x,r,n),e=t.distWidth,t=t.distHeight,e=(l+e)/l,t=(f+t)/f,e=b[0]||x?e*d[0]:d[0],t=b[1]||x?t*d[1]:d[1];return[e=0===e?1e-9*(0<u[0]?1:-1):e,t=0===t?1e-9*(0<u[1]?1:-1):t]}var y=E(),p=(o||!t.props.groupable||D(p=(e.snapRenderInfo||{}).direction)&&(p[0]||p[1])&&(e.snapRenderInfo={direction:c,request:n.isRequest}),nt(t,"onBeforeScale",et(t,n,{scale:y,setFixedDirection:function(t){return r.setFixedDirection(t),y=E()},startFixedDirection:r.startFixedDirection,setScale:function(t){y=t}},!0)),[y[0]/d[0],y[1]/d[1]]),e=a,S=[0,0],i=(a||(e=!i&&o?lr(t,[0,0]):r.fixedPosition),o||(S=eo(t,p,c,s,r)),x?(b[0]&&b[1]&&S[0]&&S[1]&&(Math.abs(S[0]*l)>Math.abs(S[1]*f)?S[1]=0:S[0]=0),(a=!S[0]&&!S[1])&&(h?p[0]=N(p[0]*d[0],v)/d[0]:p[1]=N(p[1]*d[1],v)/d[1]),b[0]&&!b[1]||S[0]&&!S[1]||a&&h?(p[0]+=S[0],i=l*p[0]*d[0]/g,p[1]=i/f/d[1]):(!b[0]&&b[1]||!S[0]&&S[1]||a&&!h)&&(p[1]+=S[1],s=f*p[1]*d[1]*g,p[0]=s/l/d[0])):(p[0]+=S[0],p[1]+=S[1],S[0]||(p[0]=N(p[0]*d[0],v)/d[0]),S[1]||(p[1]=N(p[1]*d[1],v)/d[1])),0===p[0]&&(p[0]=1e-9*(0<u[0]?1:-1)),0===p[1]&&(p[1]=1e-9*(0<u[1]?1:-1)),[p[0]/u[0],p[1]/u[1]]),s=(y=[p[0]*d[0],p[1]*d[1]],a=r.fixedDirection,h=e,g=r,sr(t,"scale(".concat(p.join(", "),")"),a,h,g)),S=T(s,r.prevInverseDist||[0,0]);if(r.prevDist=p,r.prevInverseDist=s,y[0]===u[0]&&y[1]===u[1]&&S.every(function(t){return!t})&&!m)return!1;v=Ln(r,"scale(".concat(y.join(", "),")"),"scale(".concat(p.join(", "),")")),e=et(t,n,A({offsetWidth:l,offsetHeight:f,direction:c,scale:y,dist:p,delta:i,isPinch:!!o},ar(t,v,S,o,n)));return nt(t,"onScale",e),e},dragControlEnd:function(t,e){var n=e.datas,r=e.isDrag;return!!n.isScale&&(n.isScale=!1,nt(t,"onScaleEnd",y(t,e,{})),r)},dragGroupControlCondition:le,dragGroupControlStart:function(i,t){var o=t.datas,e=this.dragControlStart(i,t);if(!e)return!1;var r=ri(i,"resizable",t);function a(t,e){var n=o.fixedDirection,r=o.fixedPosition,t=j(e.datas.startPositions||W(t.state),n),n=B(De(-i.rotation/180*Math.PI,3),[t[0]-r[0],t[1]-r[1],1],3),t=n[0],r=n[1];return e.datas.originalX=t,e.datas.originalY=r,e}o.moveableScale=i.scale;function n(n){e.setFixedDirection(n),s.forEach(function(t,e){t.setFixedDirection(n),a(t.moveable,r[e])})}var s=oi(i,this,"dragControlStart",t,a),t=(o.setFixedDirection=n,A(A({},e),{targets:i.props.targets,events:s,setFixedDirection:n})),u=nt(i,"onScaleGroupStart",t);return o.isScale=!1!==u,!!o.isScale&&t},dragGroupControl:function(i,e){var t=e.datas;if(t.isScale){Nr(i,"onBeforeScale",function(t){nt(i,"onBeforeScaleGroup",et(i,e,A(A({},t),{targets:i.props.targets}),!0))});var o,a,s,u,n,r=this.dragControl(i,e);if(r)return n=t.moveableScale,i.scale=[r.scale[0]*n[0],r.scale[1]*n[1]],o=i.props.keepRatio,a=r.dist,s=r.scale,u=t.fixedPosition,n=oi(i,this,"dragControl",e,function(t,e){var n=B(De(i.rotation/180*Math.PI,3),[e.datas.originalX*a[0],e.datas.originalY*a[1],1],3),r=n[0],n=n[1];return A(A({},e),{parentDist:null,parentScale:s,parentKeepRatio:o,dragClient:J(u,[r,n])})}),t=A({targets:i.props.targets,events:n},r),nt(i,"onScaleGroup",t),t}},dragGroupControlEnd:function(t,e){var n,r=e.isDrag;if(e.datas.isScale)return this.dragControlEnd(t,e),n=oi(t,this,"dragControlEnd",e),nt(t,"onScaleGroupEnd",y(t,e,{targets:t.props.targets,events:n})),r},request:function(){var e={},n=0,r=0;return{isControl:!0,requestStart:function(t){return{datas:e,parentDirection:t.direction||[1,1]}},request:function(t){return n+=t.deltaWidth,r+=t.deltaHeight,{datas:e,parentDist:[n,r],parentKeepRatio:t.keepRatio}},requestEnd:function(){return{datas:e,isDrag:!0}}}}};function xo(t,n){return t.map(function(t,e){return rt(t,n[e],1,2)})}function Eo(t,e,n){e=I(t,e),t=I(t,n)-e;return 0<=t?t:t+2*Math.PI}var bo={name:"warpable",ableGroup:"size",props:{warpable:Boolean,renderDirections:Array,edge:Boolean},events:{onWarpStart:"warpStart",onWarp:"warp",onWarpEnd:"warpEnd"},render:function(t,e){var n=t.props,r=n.resizable,i=n.scalable,o=n.warpable,n=n.zoom;if(r||i||!o)return[];var r=t.state,i=r.pos1,o=r.pos2,a=r.pos3,r=r.pos4,s=xo(i,o),u=xo(o,i),c=xo(i,a),i=xo(a,i),l=xo(a,r),a=xo(r,a),f=xo(o,r),r=xo(r,o);return Q([e.createElement("div",{className:G("line"),key:"middeLine1",style:Rr(s,l,n)}),e.createElement("div",{className:G("line"),key:"middeLine2",style:Rr(u,a,n)}),e.createElement("div",{className:G("line"),key:"middeLine3",style:Rr(c,f,n)}),e.createElement("div",{className:G("line"),key:"middeLine4",style:Rr(i,r,n)})],lo(t,"warpable",e),!0)},dragControlCondition:function(t,e){if(e.isRequest)return!1;e=e.inputEvent.target;return P(e,G("direction"))&&P(e,G("warpable"))},dragControlStart:function(t,e){var n=e.datas,r=e.inputEvent,i=t.props.target,r=Gr(r.target);if(!r||!i)return!1;var i=t.state,o=i.transformOrigin,a=i.is3d,s=i.targetTransform,u=i.targetMatrix,c=i.width,l=i.height,f=i.left,p=i.top;return n.datas={},n.targetTransform=s,n.warpTargetMatrix=a?u:ve(u,3,4),n.targetInverseMatrix=pe(de(n.warpTargetMatrix,4),3,4),n.direction=r,n.left=f,n.top=p,n.poses=[[0,0],[c,0],[0,l],[c,l]].map(function(t){return T(t,o)}),n.nextPoses=n.poses.map(function(t){var e=t[0],t=t[1];return B(n.warpTargetMatrix,[e,t,0,1],4)}),n.startValue=Y(4),n.prevMatrix=Y(4),n.absolutePoses=W(i),n.posIndexes=Zn(r),Wn(t,e),Qn(e,"matrix3d"),!(i.snapRenderInfo={request:e.isRequest,direction:r})!==nt(t,"onWarpStart",et(t,e,A({set:function(t){n.startValue=t}},Jn(e))))&&(n.isWarp=!0),n.isWarp},dragControl:function(t,e){var n=e.datas,r=e.isRequest,i=e.distX,o=e.distY,a=n.targetInverseMatrix,s=n.prevMatrix,u=n.isWarp,c=n.startValue,l=n.poses,f=n.posIndexes,p=n.absolutePoses;if(!u)return!1;qn(e,"matrix3d"),li(t,"warpable")&&(1<(u=f.map(function(t){return p[t]})).length&&u.push([(u[0][0]+u[1][0])/2,(u[0][1]+u[1][1])/2]),u=(r=qi(t,r,{horizontal:u.map(function(t){return t[1]+o}),vertical:u.map(function(t){return t[0]+i})})).horizontal,r=r.vertical,o-=u.offset,i-=r.offset);var d=$n({datas:n,distX:i,distY:o},!0),h=n.nextPoses.slice();if(f.forEach(function(t){h[t]=J(h[t],d)}),!Pn.every(function(t){return e=t.map(function(t){return l[t]}),t=t.map(function(t){return h[t]}),e=Eo(e[0],e[1],e[2]),t=Eo(t[0],t[1],t[2]),!((n=Math.PI)<=e&&t<=n||e<=n&&n<=t);var e,n}))return!1;u=_e(l[0],l[2],l[1],l[3],h[0],h[2],h[1],h[3]);if(!u.length)return!1;r=Vn(n,K(a,u,4),!0),f=K(de(s,4),r,4),a=K(c,n.prevMatrix=r,4),u=Ln(n,"matrix3d(".concat(a.join(", "),")"),"matrix3d(".concat(r.join(", "),")"));return er(e,u),nt(t,"onWarp",et(t,e,{delta:f,matrix:a,dist:r,multiply:K,transform:u})),!0},dragControlEnd:function(t,e){var n=e.datas,r=e.isDrag;return!!n.isWarp&&(n.isWarp=!1,nt(t,"onWarpEnd",y(t,e,{})),r)}},yo=G("area-pieces"),So=G("area-piece"),Mo=G("avoid");function Co(t){var e,n,r,i=t.areaElement;i&&(e=(t=t.state).width,t=t.height,r=Mo,(n=i).classList?n.classList.remove(r):(r=new RegExp("(\\s|^)"+r+"(\\s|$)"),n.className=n.className.replace(r," ")),i.style.cssText+="left: 0px; top: 0px; width: ".concat(e,"px; height: ").concat(t,"px"))}function wo(t){return t.createElement("div",{key:"area_pieces",className:yo},t.createElement("div",{className:So}),t.createElement("div",{className:So}),t.createElement("div",{className:So}),t.createElement("div",{className:So}))}var Do={name:"dragArea",props:{dragArea:Boolean,passDragArea:Boolean},events:{onClick:"click",onClickGroup:"clickGroup"},render:function(t,e){var n=t.props,r=n.target,i=n.dragArea,o=n.groupable,n=n.passDragArea,a=t.state,s=a.width,u=a.height,a=a.renderPoses,n=n?G("area","pass"):G("area");if(o)return[e.createElement("div",{key:"area",ref:S(t,"areaElement"),className:n}),wo(e)];if(!r||!i)return[];o=_e([0,0],[s,0],[0,u],[s,u],a[0],a[1],a[2],a[3]),r=o.length?Er(o,!0):"none";return[e.createElement("div",{key:"area",ref:S(t,"areaElement"),className:n,style:{top:"0px",left:"0px",width:"".concat(s,"px"),height:"".concat(u,"px"),transformOrigin:"0 0",transform:r}}),wo(e)]},dragStart:function(t,e){var n=e.datas,r=e.clientX,i=e.clientY;if(!e.inputEvent)return!1;n.isDragArea=!1;var e=t.areaElement,n=t.state,t=n.moveableClientRect,o=n.renderPoses,a=n.rootMatrix,s=n.is3d,u=t.left,t=t.top,o=tt(o),c=o.left,l=o.top,f=o.width,o=o.height,a=Lr(a,[r-u,i-t],s?4:3),r=a[0],u=a[1],i=[{left:c,top:l,width:f,height:(u-=l)-10},{left:c,top:l,width:(r-=c)-10,height:o},{left:c,top:l+u+10,width:f,height:o-u-10},{left:c+r+10,top:l,width:f-r-10,height:o}],p=[].slice.call(e.nextElementSibling.children);i.forEach(function(t,e){p[e].style.cssText="left: ".concat(t.left,"px;top: ").concat(t.top,"px; width: ").concat(t.width,"px; height: ").concat(t.height,"px;")}),t=Mo,(s=e).classList?s.classList.add(t):s.className+=" "+t,n.disableNativeEvent=!0},drag:function(t,e){var n=e.datas,e=e.inputEvent;if(this.enableNativeEvent(t),!e)return!1;n.isDragArea||(n.isDragArea=!0,Co(t))},dragEnd:function(t,e){this.enableNativeEvent(t);var n=e.inputEvent,e=e.datas;if(!n)return!1;e.isDragArea||Co(t)},dragGroupStart:function(t,e){return this.dragStart(t,e)},dragGroup:function(t,e){return this.drag(t,e)},dragGroupEnd:function(t,e){return this.dragEnd(t,e)},unset:function(t){Co(t),t.state.disableNativeEvent=!1},enableNativeEvent:function(t){var e=t.state;e.disableNativeEvent&&xt(function(){e.disableNativeEvent=!1})}},o=En("origin",{render:function(t,e){var n=t.props.zoom,t=t.state,r=t.beforeOrigin,t=t.rotation;return[e.createElement("div",{className:G("control","origin"),style:Or(t,n,r),key:"beforeOrigin"})]}});function Ro(t){t=t.scrollContainer;return[t.scrollLeft,t.scrollTop]}var le={name:"scrollable",canPinch:!0,props:{scrollable:Boolean,scrollContainer:Object,scrollThreshold:Number,getScrollPosition:Function},events:{onScroll:"scroll",onScrollGroup:"scrollGroup"},dragRelation:"strong",dragStart:function(n,r){var t=n.props.scrollContainer,t=void 0===t?n.getContainer():t,e=new Je,t=Jr(t,!0),i=(r.datas.dragScroll=e,r.isControl?"controlGesto":"targetGesto"),o=r.targets;e.on("scroll",function(t){var e=t.container,t=t.direction,e=et(n,r,{scrollContainer:e,direction:t}),t=o?"onScrollGroup":"onScroll";o&&(e.targets=o),nt(n,t,e)}).on("move",function(t){var e=t.offsetX,t=t.offsetY;n[i].scrollBy(e,t,r.inputEvent,!1)}),e.dragStart(r,{container:t})},checkScroll:function(t,e){var n,r,i,o=e.datas.dragScroll;if(o)return r=t.props,n=r.scrollContainer,t=void 0===n?t.getContainer():n,n=r.scrollThreshold,r=r.getScrollPosition,i=void 0===r?Ro:r,o.drag(e,{container:t,threshold:void 0===n?0:n,getScrollPosition:function(t){return i({scrollContainer:t.container,direction:t.direction})}}),!0},drag:function(t,e){return this.checkScroll(t,e)},dragEnd:function(t,e){e.datas.dragScroll.dragEnd(),e.datas.dragScroll=null},dragControlStart:function(t,e){return this.dragStart(t,A(A({},e),{isControl:!0}))},dragControl:function(t,e){return this.drag(t,e)},dragControlEnd:function(t,e){return this.dragEnd(t,e)},dragGroupStart:function(t,e){return this.dragStart(t,A(A({},e),{targets:t.props.targets}))},dragGroup:function(t,e){return this.drag(t,A(A({},e),{targets:t.props.targets}))},dragGroupEnd:function(t,e){return this.dragEnd(t,A(A({},e),{targets:t.props.targets}))},dragGroupControlStart:function(t,e){return this.dragStart(t,A(A({},e),{targets:t.props.targets,isControl:!0}))},dragGroupContro:function(t,e){return this.drag(t,A(A({},e),{targets:t.props.targets}))},dragGroupControEnd:function(t,e){return this.dragEnd(t,A(A({},e),{targets:t.props.targets}))}},Oo={name:"",props:{target:Object,dragTarget:Object,container:Object,portalContainer:Object,rootContainer:Object,useResizeObserver:Boolean,zoom:Number,transformOrigin:Array,edge:Object,ables:Array,className:String,pinchThreshold:Number,pinchOutside:Boolean,triggerAblesSimultaneously:Boolean,checkInput:Boolean,cspNonce:String,translateZ:Number,hideDefaultLines:Boolean,props:Object,flushSync:Function,stopPropagation:Boolean,preventClickEventOnDrag:Boolean,preventClickDefault:Boolean},events:{}},_o=En("padding",{render:function(t,r){var e=t.props;if(e.dragArea)return[];var e=e.padding||{},n=e.left,i=e.top,i=void 0===i?0:i,o=e.right,o=void 0===o?0:o,e=e.bottom,e=void 0===e?0:e,t=t.state,a=t.renderPoses,s=[t.pos1,t.pos2,t.pos3,t.pos4],t=[];return 0<(void 0===n?0:n)&&t.push([0,2]),0<i&&t.push([0,1]),0<o&&t.push([1,3]),0<e&&t.push([2,3]),t.map(function(t,e){var n=t[0],t=t[1],n=_e([0,0],[100,0],[0,100],[100,100],s[n],s[t],a[n],a[t]);if(n.length)return r.createElement("div",{key:"padding".concat(e),className:G("padding"),style:{transform:Er(n,!0)}})})}}),Po=["nw","ne","se","sw"];function Bo(t,e){var n=t[0]+t[1],n=e<n?e/n:1;return t[0]*=n,t[1]=e-t[1]*n,t}var zo=[1,2,5,6],To=[0,3,4,7],Go=[1,-1,-1,1],ko=[1,1,-1,-1];function Ao(t,i,o,a,s,u,c,l,f){void 0===u&&(u=0),void 0===c&&(c=0),void 0===l&&(l=a),void 0===f&&(f=s);var p=[],d=!1,t=t.map(function(t,e){var n,e=i[e],r=e.horizontal,e=e.vertical;return e&&!d&&(d=!0,p.push("/")),d?(n=Math.max(0,1===e?t[1]-c:f-t[1]),p.push(Ur(n,s,o))):(n=Math.max(0,1===r?t[0]-u:l-t[0]),p.push(Ur(n,a,o))),n});return{styles:p,raws:t}}function Fo(t){for(var e=[0,0],n=[0,0],r=t.length,i=0;i<r;++i){var o=t[i];o.sub&&(o.horizontal&&(0===e[1]&&(e[0]=i),e[1]=i-e[0]+1,n[0]=i+1),o.vertical&&(0===n[1]&&(n[0]=i),n[1]=i-n[0]+1))}return{horizontalRange:e,verticalRange:n}}function Io(t,r,i,o,a,e){void 0===e&&(e=[0,0]);var n=t.indexOf("/"),n=(-1<n?t.slice(0,n):t).length,s=t.slice(0,n),t=t.slice(n+1),n=s[0],n=void 0===n?"0px":n,u=s[1],u=void 0===u?n:u,c=s[2],c=void 0===c?n:c,l=s[3],l=void 0===l?u:l,f=t[0],f=void 0===f?n:f,p=t[1],p=void 0===p?f:p,d=t[2],d=void 0===d?f:d,h=t[3],h=void 0===h?p:h,g=[n,u,c,l].map(function(t){return Z(t,r)}),v=[f,p,d,h].map(function(t){return Z(t,i)}),n=g.slice(),u=v.slice(),c=Bo([n[0],n[1]],r),d=(n[0]=c[0],n[1]=c[1],l=Bo([n[3],n[2]],r),n[3]=l[0],n[2]=l[1],f=Bo([u[0],u[3]],i),u[0]=f[0],u[3]=f[1],p=Bo([u[1],u[2]],i),u[1]=p[0],u[2]=p[1],n.slice(0,Math.max(e[0],s.length))),h=u.slice(0,Math.max(e[1],t.length));return Q(Q([],d.map(function(t,e){var n=Po[e];return{horizontal:Go[e],vertical:0,pos:[o+t,a+(-1===ko[e]?i:0)],sub:!0,raw:g[e],direction:n}}),!0),h.map(function(t,e){var n=Po[e];return{horizontal:0,vertical:ko[e],pos:[o+(-1===Go[e]?r:0),a+t],sub:!0,raw:v[e],direction:n}}),!0)}function No(t,e,n,r,i){void 0===i&&(i=e.length);var o=Fo(t.slice(r)),a=o.horizontalRange,o=o.verticalRange,r=n-r,s=0;if(0==r)s=i;else if(0<r&&r<a[1])s=a[1]-r;else{if(!(r>=o[0]))return;s=o[0]+o[1]-r}t.splice(n,s),e.splice(n,s)}function jo(t,e,n,r,i,o,a,s,u,c,l){void 0===c&&(c=0),void 0===l&&(l=0);var f=Fo(t.slice(n)),p=f.horizontalRange,f=f.verticalRange;if(-1<r)for(var d=1===Go[r]?o-c:s-o,h=p[1];h<=r;++h){var g=1===ko[h]?l:u,v=0;if(r===h?v=o:0===h?v=c+d:-1===Go[h]&&(v=s-(e[n][0]-c)),t.splice(n+h,0,{horizontal:Go[h],vertical:0,pos:[v,g]}),e.splice(n+h,0,[v,g]),0===h)break}else if(-1<i)for(var m=1===ko[i]?a-l:u-a,b=(0===p[1]&&0===f[1]&&(t.push({horizontal:Go[0],vertical:0,pos:p=[c+m,l]}),e.push(p)),f[0]),h=f[1];h<=i;++h){v=1===Go[h]?c:s,g=0;if(i===h?g=a:0===h?g=l+m:1===ko[h]?g=e[n+b][1]:-1===ko[h]&&(g=u-(e[n+b][1]-l)),t.push({horizontal:0,vertical:ko[h],pos:[v,g]}),e.push([v,g]),0===h)break}}function Yo(t,n){return void 0===n&&(n=t.map(function(t){return t.raw})),{horizontals:t.map(function(t,e){return t.horizontal?n[e]:null}).filter(function(t){return null!=t}),verticals:t.map(function(t,e){return t.vertical?n[e]:null}).filter(function(t){return null!=t})}}var Xo=[[0,-1,"n"],[1,0,"e"]],Wo=[[-1,-1,"nw"],[0,-1,"n"],[1,-1,"ne"],[1,0,"e"],[1,1,"se"],[0,1,"s"],[-1,1,"sw"],[-1,0,"w"]];function qo(t,e,n){var r=t.props.clipRelative,t=t.state,i=t.width,o=t.height,t=e.type,e=e.poses,a="rect"===t,s="circle"===t;if("polygon"===t)return n.map(function(t){return"".concat(Ur(t[0],i,r)," ").concat(Ur(t[1],o,r))});if(a||"inset"===t){var u=n[1][1],c=n[3][0],l=n[7][0],f=n[5][1];if(a)return[u,c,f,l].map(function(t){return"".concat(t,"px")});var p,d=[u,i-c,o-f,l].map(function(t,e){return Ur(t,e%2?i:o,r)});return 8<n.length&&(p=(a=T(n[4],n[0]))[0],a=a[1],d.push.apply(d,Q(["round"],Ao(n.slice(8),e.slice(8),r,p,a,l,u,c,f).styles,!1))),d}return s||"ellipse"===t?(e=n[0],p=Ur(Math.abs(n[1][1]-e[1]),s?Math.sqrt((i*i+o*o)/2):o,r),(d=s?[p]:[Ur(Math.abs(n[2][0]-e[0]),i,r),p]).push("at",Ur(e[0],i,r),Ur(e[1],o,r)),d):void 0}function Lo(t,e,n,r){var o=[r,(r+e)/2,e],a=[t,(t+n)/2,n];return Wo.map(function(t){var e=t[0],n=t[1],t=t[2],r=o[e+1],i=a[n+1];return{vertical:Math.abs(n),horizontal:Math.abs(e),direction:t,pos:[r,i]}})}function Ho(t){var e=[1/0,-1/0],n=[1/0,-1/0];return t.forEach(function(t){t=t.pos;e[0]=Math.min(e[0],t[0]),e[1]=Math.max(e[1],t[0]),n[0]=Math.min(n[0],t[1]),n[1]=Math.max(n[1],t[1])}),[Math.abs(e[1]-e[0]),Math.abs(n[1]-n[0])]}function Vo(t,n,r,e,i){var o,a,s,u,c,l,f,p,d,h,g,v,m,b,x,E;if((i=i?i:"none"!==(o=(t=jr(t)).clipPath)?o:t.clip)&&"none"!==i&&"auto"!==i||(i=e))return o=dt(i),t=o.prefix,e=void 0===t?i:t,t=o.value,o=void 0===t?"":t,t="circle"===e,a=" ","polygon"===e?(a=",",{type:e,clipText:i,poses:E=(h=pt(o||"0% 0%, 100% 0%, 100% 100%, 0% 100%")).map(function(t){var t=t.split(" "),e=t[0],t=t[1];return{vertical:1,horizontal:1,pos:[Z(e,n),Z(t,r)]}}),splitter:a}):t||"ellipse"===e?(f=d="",u=s=0,h=ft(o),u=t?(p=h[0],d=void 0===(l=h[2])?"50%":l,f=void 0===(l=h[3])?"50%":l,s=Z(void 0===p?"50%":p,Math.sqrt((n*n+r*r)/2))):(l="",p=h[0],l=void 0===(g=h[1])?"50%":g,d=void 0===(g=h[3])?"50%":g,f=void 0===(g=h[4])?"50%":g,s=Z(void 0===p?"50%":p,n),Z(l,r)),E=Q([{vertical:1,horizontal:1,pos:c=[Z(d,n),Z(f,r)],direction:"nesw"}],Xo.slice(0,t?1:2).map(function(t){return{vertical:Math.abs(t[1]),horizontal:t[0],direction:t[2],sub:!0,pos:[c[0]+t[0]*s,c[1]+t[1]*u]}}),!0),{type:e,clipText:i,radiusX:s,radiusY:u,left:c[0]-s,top:c[1]-u,poses:E,splitter:a}):"inset"===e?(p=(-1<(g=(h=ft(o||"0 0 0 0")).indexOf("round"))?h.slice(0,g):h).length,l=h.slice(p+1),f=(d=h.slice(0,p))[0],g=void 0===(t=d[1])?f:t,p=d[2],d=void 0===(t=d[3])?g:t,v=(t=[f,void 0===p?f:p].map(function(t){return Z(t,r)}))[0],b=t[1],x=(f=[d,g].map(function(t){return Z(t,n)}))[0],m=f[1],d=Io(l,(p=n-m)-x,(t=r-b)-v,x,v),{type:"inset",clipText:i,poses:E=Q(Q([],Lo(v,p,t,x),!0),d,!0),top:v,left:x,right:p,bottom:t,radius:l,splitter:a}):"rect"===e?(a=",",{type:"rect",clipText:i,poses:E=Lo(v=(g=(h=pt(o||"0px, ".concat(n,"px, ").concat(r,"px, 0px"))).map(function(t){return ht(t).value}))[0],m=g[1],b=g[2],x=g[3]),top:v,right:m,bottom:b,left:x,values:h,splitter:a}):void 0}var Uo={name:"clippable",props:{clippable:Boolean,defaultClipPath:String,customClipPath:String,keepRatio:Boolean,clipRelative:Boolean,clipArea:Boolean,dragWithClip:Boolean,clipTargetBounds:Boolean,clipVerticalGuidelines:Array,clipHorizontalGuidelines:Array,clipSnapThreshold:Boolean},events:{onClipStart:"clipStart",onClip:"clip",onClipEnd:"clipEnd"},css:[".control.clip-control {\n    background: #6d6;\n    cursor: pointer;\n}\n.control.clip-control.clip-radius {\n    background: #d66;\n}\n.line.clip-line {\n    background: #6e6;\n    cursor: move;\n    z-index: 1;\n}\n.clip-area {\n    position: absolute;\n    top: 0;\n    left: 0;\n}\n.clip-ellipse {\n    position: absolute;\n    cursor: move;\n    border: 1px solid #6d6;\n    border: var(--zoompx) solid #6d6;\n    border-radius: 50%;\n    transform-origin: 0px 0px;\n}",":host {\n    --bounds-color: #d66;\n}",".guideline {\n    pointer-events: none;\n    z-index: 2;\n}",".line.guideline.bounds {\n    background: #d66;\n    background: var(--bounds-color);\n}"],render:function(t,o){var e=t.props,n=e.customClipPath,r=e.defaultClipPath,i=e.clipArea,a=e.zoom,e=t.state,t=e.target,s=e.width,u=e.height,c=e.allMatrix,l=e.is3d,f=e.left,p=e.top,d=e.pos1,h=e.pos2,g=e.pos3,v=e.pos4,m=e.clipPathState,b=e.snapBoundInfos,x=e.rotation;if(!t)return[];e=Vo(t,s,u,r||"inset",m||n);if(!e)return[];var E,y,S,M=l?4:3,t=e.type,r=e.poses.map(function(t){t=X(c,t.pos,M);return[t[0]-f,t[1]-p]}),m=[],C=[],n="rect"===t,l="inset"===t,w="polygon"===t;if((n||l||w)&&(E=l?r.slice(0,8):r,C=E.map(function(t,e){var n=0===e?E[E.length-1]:E[e-1],r=I(n,t),t=Dr(n,t);return o.createElement("div",{key:"clipLine".concat(e),className:G("line","clip-line","snap-control"),"data-clip-index":e,style:{width:"".concat(t,"px"),transform:"translate(".concat(n[0],"px, ").concat(n[1],"px) rotate(").concat(r,"rad) scaleY(").concat(a,")")}})})),m=r.map(function(t,e){return o.createElement("div",{key:"clipControl".concat(e),className:G("control","clip-control","snap-control"),"data-clip-index":e,style:{transform:"translate(".concat(t[0],"px, ").concat(t[1],"px) rotate(").concat(x,"rad) scale(").concat(a,")")}})}),l&&m.push.apply(m,r.slice(8).map(function(t,e){return o.createElement("div",{key:"clipRadiusControl".concat(e),className:G("control","clip-control","clip-radius","snap-control"),"data-clip-index":8+e,style:{transform:"translate(".concat(t[0],"px, ").concat(t[1],"px) rotate(").concat(x,"rad) scale(").concat(a,")")}})})),"circle"===t||"ellipse"===t){var t=e.left,D=e.top,R=e.radiusX,O=e.radiusY,e=T(X(c,[t,D],M),X(c,[0,0],M)),t=e[0],D=e[1],e="none";if(!i){for(var _=Math.max(10,R/5,O/5),P=[],B=0;B<=_;++B){var z=2*Math.PI/_*B;P.push([R+(R-a)*Math.cos(z),O+(O-a)*Math.sin(z)])}P.push([R,-2]),P.push([-2,-2]),P.push([-2,2*O+2]),P.push([2*R+2,2*O+2]),P.push([2*R+2,-2]),P.push([R,-2]),e="polygon(".concat(P.map(function(t){return"".concat(t[0],"px ").concat(t[1],"px")}).join(", "),")")}m.push(o.createElement("div",{key:"clipEllipse",className:G("clip-ellipse","snap-control"),style:{width:"".concat(2*R,"px"),height:"".concat(2*O,"px"),clipPath:e,transform:"translate(".concat(-f+t,"px, ").concat(-p+D,"px) ").concat(Er(c))}}))}return i&&(t=(e=tt(Q([d,h,g,v],r,!0))).width,D=e.height,y=e.left,S=e.top,(w||n||l)&&(P=l?r.slice(0,8):r,m.push(o.createElement("div",{key:"clipArea",className:G("clip-area","snap-control"),style:{width:"".concat(t,"px"),height:"".concat(D,"px"),transform:"translate(".concat(y,"px, ").concat(S,"px)"),clipPath:"polygon(".concat(P.map(function(t){return"".concat(t[0]-y,"px ").concat(t[1]-S,"px")}).join(", "),")")}})))),b&&["vertical","horizontal"].forEach(function(r){var t=b[r],i="horizontal"===r;t.isSnap&&C.push.apply(C,t.snap.posInfos.map(function(t,e){var t=t.pos,n=T(X(c,i?[0,t]:[t,0],M),[f,p]),t=T(X(c,i?[s,t]:[t,u],M),[f,p]);return so(o,"",n,t,a,"clip".concat(r,"snap").concat(e),"guideline")})),t.isBound&&C.push.apply(C,t.bounds.map(function(t,e){var t=t.pos,n=T(X(c,i?[0,t]:[t,0],M),[f,p]),t=T(X(c,i?[s,t]:[t,u],M),[f,p]);return so(o,"",n,t,a,"clip".concat(r,"bounds").concat(e),"guideline","bounds","bold")}))}),Q(Q([],m,!0),C,!0)},dragControlCondition:function(t,e){return e.inputEvent&&-1<(e.inputEvent.target.getAttribute("class")||"").indexOf("clip")},dragStart:function(t,e){var n=t.props.dragWithClip;return void 0!==n&&!n&&this.dragControlStart(t,e)},drag:function(t,e){return this.dragControl(t,A(A({},e),{isDragTarget:!0}))},dragEnd:function(t,e){return this.dragControlEnd(t,e)},dragControlStart:function(t,e){var n=t.state,r=t.props,i=r.defaultClipPath,r=r.customClipPath,o=n.target,a=n.width,s=n.height,u=e.inputEvent?e.inputEvent.target:null,c=u&&u.getAttribute("class")||"",l=e.datas,o=Vo(o,a,s,i||"inset",r);if(!o)return!1;a=o.clipText;return!1===nt(t,"onClipStart",et(t,e,{clipType:o.type,clipStyle:a,poses:o.poses.map(function(t){return t.pos})}))?l.isClipStart=!1:(l.isControl=c&&-1<c.indexOf("clip-control"),l.isLine=-1<c.indexOf("clip-line"),l.isArea=-1<c.indexOf("clip-area")||-1<c.indexOf("clip-ellipse"),l.clipIndex=u?parseInt(u.getAttribute("data-clip-index"),10):-1,l.clipPath=o,l.isClipStart=!0,n.clipPathState=a,Wn(t,e),!0)},dragControl:function(t,e){var n=e.datas,r=e.originalDatas,A=e.isDragTarget;if(!n.isClipStart)return!1;var i=n.isControl,o=n.isLine,a=n.isArea,s=n.clipIndex,n=n.clipPath;if(!n)return!1;var u,c,F,I,N,l,f,p,j,d,h,g,v,Y,X,W=_r(t.props,"clippable"),m=W.keepRatio,b=0,x=0,r=r.draggable,q=$n(e),x=A&&r?(L=r.prevBeforeDist,b=L[0],L[1]):(b=q[0],q[1]),L=[b,x],E=t.state,H=E.width,V=E.height,a=!a&&!i&&!o,o=n.type,y=n.poses,U=n.splitter,S=y.map(function(t){return t.pos}),a=(a&&(b=-b,x=-x),!i||"nesw"===y[s].direction),$="inset"===o||"rect"===o,M=y.map(function(){return[0,0]}),C=(i&&!a?(f=(D=y[s]).horizontal,D=D.vertical,f=[b*Math.abs(f),x*Math.abs(D)],c=f,D=$,f=m,_=(P=(u=y)[z=s]).direction,P=P.sub,l=u.map(function(){return[0,0]}),B=_?_.split(""):[],D&&z<8?(D=B.filter(function(t){return"w"===t||"e"===t}),R=B.filter(function(t){return"n"===t||"s"===t}),F=D[0],I=R[0],l[z]=c,R=(D=Ho(u))[0],D=D[1],(C=R&&D?R/D:0)&&f?(f=u[(z+4)%8].pos,w=[0,0],-1<_.indexOf("w")?w[0]=-1:-1<_.indexOf("e")&&(w[0]=1),-1<_.indexOf("n")?w[1]=-1:-1<_.indexOf("s")&&(w[1]=1),C=R+(R=ei([R,D],c,C,w,!0))[0],D=D+R[1],R=f[1],p=f[1],O=f[0],f=f[0],-1===w[0]?O=f-C:1===w[0]?f=O+C:(O-=C/2,f+=C/2),-1===w[1]?R=p-D:p=1===w[1]?R+D:(R=p-D/2)+D,N=Lo(R,f,p,O),u.forEach(function(t,e){l[e][0]=N[e].pos[0]-t.pos[0],l[e][1]=N[e].pos[1]-t.pos[1]})):(u.forEach(function(t,e){t=t.direction;t&&(-1<t.indexOf(F)&&(l[e][0]=c[0]),-1<t.indexOf(I)&&(l[e][1]=c[1]))}),F&&(l[1][0]=c[0]/2,l[5][0]=c[0]/2),I&&(l[3][1]=c[1]/2,l[7][1]=c[1]/2))):_&&!P?B.forEach(function(i){var o="n"===i||"s"===i;u.forEach(function(t,e){var n=t.direction,r=t.horizontal,t=t.vertical;n&&-1!==n.indexOf(i)&&(l[e]=[o||!r?0:c[0],o&&t?c[1]:0])})}):l[z]=c,M=l):a&&(M=S.map(function(){return[b,x]})),S.map(function(t,e){return J(t,M[e])})),w=Q([],C,!0),D=(E.snapBoundInfos=null,"circle"===n.type),R="ellipse"===n.type,O=((D||R)&&(d=tt(C),f=Math.abs(d.bottom-d.top),p=Math.abs(R?d.right-d.left:f),h=C[0][1]+f,g=C[0][0]-p,v=C[0][0]+p,D&&(w.push([v,d.bottom]),M.push([1,0])),w.push([d.left,h]),M.push([0,1]),w.push([g,d.bottom]),M.push([1,0])),Zi((W.clipHorizontalGuidelines||[]).map(function(t){return Z("".concat(t),V)}),(W.clipVerticalGuidelines||[]).map(function(t){return Z("".concat(t),H)}),H,V)),_=[],P=[],B=(P=D||R?(_=[w[4][0],w[2][0]],[w[1][1],w[3][1]]):$?(X=[w[0],w[2],w[4],w[6]],j=[M[0],M[2],M[4],M[6]],_=X.filter(function(t,e){return j[e][0]}).map(function(t){return t[0]}),X.filter(function(t,e){return j[e][1]}).map(function(t){return t[1]})):(_=w.filter(function(t,e){return M[e][0]}).map(function(t){return t[0]}),w.filter(function(t,e){return M[e][1]}).map(function(t){return t[1]})),[0,0]),z=Li(O,W.clipTargetBounds&&{left:0,top:0,right:H,bottom:V},_,P,5),a=z.horizontal,S=z.vertical,T=a.offset,G=S.offset,a=(a.isBound&&(B[1]+=T),S.isBound&&(B[0]+=G),(R||D)&&0===M[0][0]&&0===M[0][1]?(k=(d=tt(C)).bottom-d.top,d=R?d.right-d.left:k,d-=S.isBound?Math.abs(G):0===S.snapIndex?-G:G,k-=a.isBound?Math.abs(T):0===a.snapIndex?-T:T,D&&(d=k=0<xi(S,a)?k:d),S=w[0],w[1][1]=S[1]-k,w[2][0]=S[0]+d,w[3][1]=S[1]+k,w[4][0]=S[0]-d):$&&m&&i?(k=(a=Ho(y))[0],S=a[1],d=k&&S?k/S:0,m=y[s].direction||"",i=w[1][1],h=w[5][1],g=w[7][0],v=w[3][0],T<=G?T=G/d:G=T*d,-1<m.indexOf("w")?g-=G:-1<m.indexOf("e")?v-=G:(g+=G/2,v-=G/2),-1<m.indexOf("n")?i-=T:-1<m.indexOf("s")?h-=T:(i+=T/2,h-=T/2),Y=Lo(i,v,h,g),w.forEach(function(t,e){e=Y[e].pos;t[0]=e[0],t[1]=e[1]})):w.forEach(function(t,e){e=M[e];e[0]&&(t[0]-=G),e[1]&&(t[1]-=T)}),qo(t,n,C)),k="".concat(o,"(").concat(a.join(U),")");return E.clipPathState=k,P=D||R?(_=[w[4][0],w[2][0]],[w[1][1],w[3][1]]):$?(_=(X=[w[0],w[2],w[4],w[6]]).map(function(t){return t[0]}),X.map(function(t){return t[1]})):(_=w.map(function(t){return t[0]}),w.map(function(t){return t[1]})),E.snapBoundInfos=Li(O,W.clipTargetBounds&&{left:0,top:0,right:H,bottom:V},_,P,1),r&&(S=E.is3d,y=E.allMatrix,s=B,A&&(s=[L[0]+B[0]-q[0],L[1]+B[1]-q[1]]),r.deltaOffset=K(y,[s[0],s[1],0,0],S?4:3)),nt(t,"onClip",et(t,e,{clipEventType:"changed",clipType:o,poses:C,clipStyle:k,clipStyles:a,distX:b,distY:x})),!0},dragControlEnd:function(t,e){this.unset(t);var n=e.isDrag,r=e.datas,i=e.isDouble,o=r.isLine,a=r.isClipStart,r=r.isControl;return!!a&&(nt(t,"onClipEnd",y(t,e,{})),i&&(r?function(t,e){var n=(r=e.datas).clipPath,r=r.clipIndex,i=n.type,o=n.poses,a=n.splitter,s=o.map(function(t){return t.pos}),u=s.length;if("polygon"===i)o.splice(r,1),s.splice(r,1);else{if("inset"!==i)return;if(r<8)return;if(No(o,s,r,8,u),u===o.length)return}r=qo(t,n,s),nt(t,"onClip",et(t,e,{clipEventType:"removed",clipType:i,poses:s,clipStyles:r,clipStyle:"".concat(i,"(").concat(r.join(a),")"),distX:0,distY:0}))}(t,e):o&&function(t,e){var n=(r=Xn(t,e))[0],r=r[1],i=(o=e.datas).clipPath,o=o.clipIndex,a=i.type,s=i.poses,u=i.splitter,c=s.map(function(t){return t.pos});if("polygon"===a)c.splice(o,0,[n,r]);else{if("inset"!==a)return;var l=zo.indexOf(o),o=To.indexOf(o),f=s.length;if(jo(s,c,8,l,o,n,r,c[4][0],c[4][1],c[0][0],c[0][1]),f===s.length)return}l=qo(t,i,c),nt(t,"onClip",et(t,e,{clipEventType:"added",clipType:a,poses:c,clipStyles:l,clipStyle:"".concat(a,"(").concat(l.join(u),")"),distX:0,distY:0}))}(t,e)),i||n)},unset:function(t){t.state.clipPathState="",t.state.snapBoundInfos=null}},$o={name:"originDraggable",props:{originDraggable:Boolean,originRelative:Boolean},events:{onDragOriginStart:"dragOriginStart",onDragOrigin:"dragOrigin",onDragOriginEnd:"dragOriginEnd"},css:[":host[data-able-origindraggable] .control.origin {\n    pointer-events: auto;\n}"],dragControlCondition:function(t,e){return e.isRequest?"originDraggable"===e.requestAble:P(e.inputEvent.target,G("origin"))},dragControlStart:function(t,e){var n=e.datas,e=(Wn(t,e),et(t,e,{dragStart:q.dragStart(t,(new Yn).dragStart([0,0],e))})),r=nt(t,"onDragOriginStart",e);return n.startOrigin=t.state.transformOrigin,n.startTargetOrigin=t.state.targetOrigin,n.prevOrigin=[0,0],!(n.isDragOrigin=!0)===r?n.isDragOrigin=!1:e},dragControl:function(t,e){var n=e.datas,r=e.isPinch,i=e.isRequest;if(!n.isDragOrigin)return!1;var o=$n(e),a=o[0],o=o[1],s=t.state,u=s.width,c=s.height,l=s.offsetMatrix,f=s.targetMatrix,s=s.is3d,p=t.props.originRelative,p=void 0===p||p,s=s?4:3,a=[a,o],i=(!i||((o=e.distOrigin)[0]||o[1])&&(a=o),J(n.startOrigin,a)),o=J(n.startTargetOrigin,a),d=T(a,n.prevOrigin),l=Kn(l,f,i,s),f=t.getRect(),l=tt(Sr(l,u,c,s)),s=[f.left-l.left,f.top-l.top],f=et(t,e,{width:u,height:c,origin:i,dist:n.prevOrigin=a,delta:d,transformOrigin:[Ur(o[0],u,p),Ur(o[1],c,p)].join(" "),drag:q.drag(t,jn(e,t.state,s,!!r,!1))});return nt(t,"onDragOrigin",f),f},dragControlEnd:function(t,e){return!!e.datas.isDragOrigin&&(nt(t,"onDragOriginEnd",y(t,e,{})),!0)},dragGroupControlCondition:function(t,e){return this.dragControlCondition(t,e)},dragGroupControlStart:function(t,e){return!!this.dragControlStart(t,e)},dragGroupControl:function(t,e){e=this.dragControl(t,e);return!!e&&(t.transformOrigin=e.transformOrigin,!0)},request:function(t){var e={},n=t.getRect(),r=0,i=0,o=n.transformOrigin,a=[0,0];return{isControl:!0,requestStart:function(){return{datas:e}},request:function(t){return"deltaOrigin"in t?(a[0]+=t.deltaOrigin[0],a[1]+=t.deltaOrigin[1]):"origin"in t?(a[0]=t.origin[0]-o[0],a[1]=t.origin[1]-o[1]):("x"in t?r=t.x-n.left:"deltaX"in t&&(r+=t.deltaX),"y"in t?i=t.y-n.top:"deltaY"in t&&(i+=t.deltaY)),{datas:e,distX:r,distY:i,distOrigin:a}},requestEnd:function(){return{datas:e,isDrag:!0}}}}};function Zo(t,e,n,r,i){void 0===r&&(r=[0,0]);return Io(!(t=i||(t=jr(t))&&t.borderRadius||"")||!i&&"0px"===t?[]:ft(t),e,n,0,0,r)}function Ko(t,e,n,r,i,o){var a=t.state,s=a.width,u=a.height,o=Ao(o,i,t.props.roundRelative,s,u),c=o.raws,o=o.styles,i=Yo(i,c),c=i.horizontals,i=i.verticals,o=o.join(" ");nt(t,"onRound",et(t,e,{horizontals:c,verticals:i,borderRadius:a.borderRadiusState=o,width:s,height:u,delta:r,dist:n}))}var Jo={name:"roundable",props:{roundable:Boolean,roundRelative:Boolean,minRoundControls:Array,maxRoundControls:Array,roundClickable:Boolean},events:{onRoundStart:"roundStart",onRound:"round",onRoundEnd:"roundEnd"},css:[".control.border-radius {\n    background: #d66;\n    cursor: pointer;\n}",":host[data-able-roundable] .line.direction {\n    cursor: pointer;\n}"],render:function(t,r){var e=t.state,n=e.target,i=e.width,o=e.height,a=e.allMatrix,s=e.is3d,u=e.left,c=e.top,e=e.borderRadiusState,t=t.props,l=t.minRoundControls,f=t.maxRoundControls,p=void 0===f?[4,4]:f,d=t.zoom;if(!n)return null;var h=s?4:3,f=Zo(n,i,o,void 0===l?[0,0]:l,e);if(!f)return null;var g=0,v=0;return f.map(function(t,e){v+=Math.abs(t.horizontal),g+=Math.abs(t.vertical);var n=T(X(a,t.pos,h),[u,c]),t=t.vertical?g<=p[1]:v<=p[0];return r.createElement("div",{key:"borderRadiusControl".concat(e),className:G("control","border-radius"),"data-radius-index":e,style:{display:t?"block":"none",transform:"translate(".concat(n[0],"px, ").concat(n[1],"px) scale(").concat(d,")")}})})},dragControlCondition:function(t,e){if(!e.inputEvent||e.isRequest)return!1;e=e.inputEvent.target.getAttribute("class")||"";return-1<e.indexOf("border-radius")||-1<e.indexOf("moveable-line")&&-1<e.indexOf("moveable-direction")},dragControlStart:function(t,e){var n=e.inputEvent,r=e.datas,n=n.target,i=n.getAttribute("class")||"",o=-1<i.indexOf("border-radius"),i=-1<i.indexOf("moveable-line")&&-1<i.indexOf("moveable-direction"),a=o?parseInt(n.getAttribute("data-radius-index"),10):-1,n=i?parseInt(n.getAttribute("data-line-index"),10):-1;if(!o&&!i)return!1;if(!1===nt(t,"onRoundStart",et(t,e,{})))return!1;r.lineIndex=n,r.controlIndex=a,r.isControl=o,r.isLine=i,Wn(t,e);n=t.props,a=n.roundRelative,o=n.minRoundControls,i=void 0===o?[0,0]:o,e=t.state,n=e.target,o=e.width,t=e.height,r.isRound=!0,r.prevDist=[0,0],n=Zo(n,o,t,i)||[];return r.controlPoses=n,e.borderRadiusState=Ao(n.map(function(t){return t.pos}),n,a,o,t).styles.join(" "),!0},dragControl:function(t,e){var n=e.datas;if(!n.isRound||!n.isControl||!n.controlPoses.length)return!1;var r=n.controlIndex,i=n.controlPoses,o=$n(e),a=o[0],o=o[1],s=[a,o],u=T(s,n.prevDist),c=t.props.maxRoundControls,l=void 0===c?[4,4]:c,c=t.state,f=c.width,p=c.height,c=i[r],d=c.vertical,h=c.horizontal,g=i.map(function(t){var e=t.horizontal,t=t.vertical,n=[e*h*s[0],t*d*s[1]];if(e){if(1===l[0])return n;if(l[0]<4&&e!==h)return n}else{if(0===l[1])return n[1]=t*h*s[0]/f*p,n;if(d){if(1===l[1])return n;if(l[1]<4&&t!==d)return n}}return[0,0]}),c=(g[r]=s,i.map(function(t,e){return J(t.pos,g[e])}));return n.prevDist=[a,o],Ko(t,e,s,u,i,c),!0},dragControlEnd:function(t,e){var n=t.state,r=(n.borderRadiusState="",e.datas),i=e.isDouble;if(!r.isRound)return!1;var o,a,s,u=n.width,c=n.height,l=r.isControl,f=r.controlIndex,p=r.isLine,d=r.lineIndex,r=r.controlPoses,h=r.map(function(t){return t.pos}),g=h.length,v=t.props.roundClickable;return i&&(void 0===v||v)&&(l?No(r,h,f,0):p&&(v=(i=Xn(t,e))[0],l=i[1],f=h,p=d,i=v,d=l,v=u,l=c,o=(c=Yo(u=r)).horizontals,c=c.verticals,o=o.length,c=c.length,s=a=-1,0===p?0===o?a=0:1===o&&(a=1):3===p&&(o<=2?a=2:o<=3&&(a=3)),2===p?0===c?s=0:c<4&&(s=3):1===p&&(c<=1?s=1:c<=2&&(s=2)),jo(u,f,0,a,s,i,d,v,l)),g!==r.length&&Ko(t,e,[0,0],[0,0],r,h)),nt(t,"onRoundEnd",y(t,e,{})),!(n.borderRadiusState="")},unset:function(t){t.state.borderRadiusState=""}};var Qo={isPinch:!0,name:"beforeRenderable",props:{},events:{onBeforeRenderStart:"beforeRenderStart",onBeforeRender:"beforeRender",onBeforeRenderEnd:"beforeRenderEnd",onBeforeRenderGroupStart:"beforeRenderGroupStart",onBeforeRenderGroup:"beforeRenderGroup",onBeforeRenderGroupEnd:"beforeRenderGroupEnd"},dragRelation:"weak",setTransform:function(t,e){var t=t.state,n=t.is3d,r=t.target,t=t.targetMatrix,r=null==r?void 0:r.style.transform,t=n?"matrix3d(".concat(t.join(","),")"):"matrix(".concat(be(t,!0),")"),r=r&&"none"!==r?r:t;e.datas.startTransforms=(t=r,n=Y((e=n)?4:3),t==="matrix".concat(e?"3d":"","(").concat(n.join(","),")")||"matrix(1,0,0,1,0,0)"===t?[]:ft(r))},resetStyle:function(t){var e=t.datas;e.nextStyle={},e.nextTransforms=t.datas.startTransforms,e.nextTransformAppendedIndexes=[]},fillDragStartParams:function(t,e){return et(t,e,{setTransform:function(t){e.datas.startTransforms=D(t)?t:ft(t)},isPinch:!!e.isPinch})},fillDragParams:function(t,e){return et(t,e,{isPinch:!!e.isPinch})},dragStart:function(t,e){this.setTransform(t,e),nt(t,"onBeforeRenderStart",this.fillDragStartParams(t,e))},drag:function(t,e){this.resetStyle(e),e.datas.nextStyle={},nt(t,"onBeforeRender",et(t,e,{isPinch:!!e.isPinch}))},dragEnd:function(t,e){nt(t,"onBeforeRenderEnd",et(t,e,{isPinch:!!e.isPinch,isDrag:e.isDrag}))},dragGroupStart:function(t,e){var n=this,r=(this.dragStart(t,e),ri(t,"beforeRenderable",e)),i=t.moveables,r=r.map(function(t,e){e=i[e];return n.setTransform(e,t),n.fillDragStartParams(e,t)});nt(t,"onBeforeRenderGroupStart",et(t,e,{isPinch:!!e.isPinch,targets:t.props.targets,setTransform:function(){},events:r}))},dragGroup:function(t,n){var r=this,e=(this.drag(t,n),ri(t,"beforeRenderable",n)),i=t.moveables,e=e.map(function(t,e){e=i[e];return r.resetStyle(t),n.datas.nextStyle={},r.fillDragParams(e,t)});nt(t,"onBeforeRenderGroup",et(t,n,{isPinch:!!n.isPinch,targets:t.props.targets,events:e}))},dragGroupEnd:function(t,e){this.dragEnd(t,e),nt(t,"onBeforeRenderGroupEnd",et(t,e,{isPinch:!!e.isPinch,isDrag:e.isDrag,targets:t.props.targets}))},dragControlStart:function(t,e){return this.dragStart(t,e)},dragControl:function(t,e){return this.drag(t,e)},dragControlEnd:function(t,e){return this.dragEnd(t,e)},dragGroupControlStart:function(t,e){return this.dragGroupStart(t,e)},dragGroupControl:function(t,e){return this.dragGroup(t,e)},dragGroupControlEnd:function(t,e){return this.dragGroupEnd(t,e)}},ta={name:"renderable",props:{},events:{onRenderStart:"renderStart",onRender:"render",onRenderEnd:"renderEnd",onRenderGroupStart:"renderGroupStart",onRenderGroup:"renderGroup",onRenderGroupEnd:"renderGroupEnd"},dragRelation:"weak",dragStart:function(t,e){nt(t,"onRenderStart",et(t,e,{isPinch:!!e.isPinch}))},drag:function(t,e){nt(t,"onRender",this.fillDragParams(t,e))},dragAfter:function(t,e){if(e.resultCount)return this.drag(t,e)},dragEnd:function(t,e){nt(t,"onRenderEnd",this.fillDragEndParams(t,e))},dragGroupStart:function(t,e){nt(t,"onRenderGroupStart",et(t,e,{isPinch:!!e.isPinch,targets:t.props.targets}))},dragGroup:function(t,e){var n=this,r=ri(t,"beforeRenderable",e),i=t.moveables,r=r.map(function(t,e){e=i[e];return n.fillDragParams(e,t)});nt(t,"onRenderGroup",et(t,e,A(A({isPinch:!!e.isPinch,targets:t.props.targets,transform:ir(e)},Fr(or(e))),{events:r})))},dragGroupEnd:function(t,e){var n=this,r=ri(t,"beforeRenderable",e),i=t.moveables,r=r.map(function(t,e){e=i[e];return n.fillDragEndParams(e,t)});nt(t,"onRenderGroupEnd",et(t,e,{isPinch:!!e.isPinch,isDrag:e.isDrag,targets:t.props.targets,events:r}))},dragControlStart:function(t,e){return this.dragStart(t,e)},dragControl:function(t,e){return this.drag(t,e)},dragControlAfter:function(t,e){return this.dragAfter(t,e)},dragControlEnd:function(t,e){return this.dragEnd(t,e)},dragGroupControlStart:function(t,e){return this.dragGroupStart(t,e)},dragGroupControl:function(t,e){return this.dragGroup(t,e)},dragGroupControlEnd:function(t,e){return this.dragGroupEnd(t,e)},fillDragParams:function(t,e){return et(t,e,A({isPinch:!!e.isPinch,transform:ir(e)},Fr(or(e))))},fillDragEndParams:function(t,e){return et(t,e,{isPinch:!!e.isPinch,isDrag:e.isDrag})}};function ea(n,t,e,r,i,o,a){var s="Start"===i,u=n.state.target,c=o.isRequest;if(!u||s&&-1<r.indexOf("Control")&&!c&&n.areaElement===o.inputEvent.target)return!1;var l,f="".concat(e).concat(r).concat(i),p="".concat(e).concat(r,"Condition"),d="End"===i,u="After"===i,h=!(!s||n.targetGesto&&n.controlGesto&&n.targetGesto.isFlag()&&n.controlGesto.isFlag()),g=(h&&n.updateRect(i,!0,!1),""!==i||c||Hr(n.state,o),Q([],n[t],!0));if(c&&(l=o.requestAble,g.some(function(t){return t.name===l})||g.push.apply(g,n.props.ables.filter(function(t){return t.name===l}))),!g.length||g.every(function(t){return t.dragRelation}))return!1;function v(){var t;y=!0,null!=(t=o.stop)&&t.call(o)}var m,g=Q(Q([Qo],g,!0),[ta],!1).filter(function(t){return t[f]}),b=o.datas,x=(h&&g.forEach(function(t){t.unset&&t.unset(n)}),o.inputEvent),E=(d&&x&&(m=document.elementFromPoint(o.clientX,o.clientY)||x.target),0),y=!1,x=g.filter(function(t){var e=t.name,e=b[e]||(b[e]={});return s&&(e.isEventStart=!t[p]||t[p](n,o)),!!e.isEventStart&&(t=t[f](n,A(A({},o),{stop:v,resultCount:E,datas:e,originalDatas:b,inputTarget:m})),n._emitter.off(),s&&!1===t&&(e.isEventStart=!1),E+=t?1:0,t)}).length,S=!1;return s&&(y||g.length&&!x)&&(S=y||g.filter(function(t){var e=t.name;return!!b[e].isEventStart&&"strong"!==t.dragRelation}).length),(d||S)&&(n.state.gestos={},n.moveables&&n.moveables.forEach(function(t){t.state.gestos={}})),h&&S&&g.forEach(function(t){t.unset&&t.unset(n)}),s&&!S&&!c&&x&&null!=o&&o.preventDefault(),!n.isUnmounted&&!S&&((!s&&x&&!a||d)&&(n.props.flushSync||fr)(function(){n.updateRect(d?i:"",!0,!1),n.forceUpdate()}),s||d||u||!x||a||ea(n,t,e,r,i+"After",o),!0)}function na(n,t,e){function r(t){var t=t.inputEvent.target,e=n.areaElement;return a&&(t===a||a.contains(t))||t===e||!n.isMoveableElement(t)&&!n.controlBox.getElement().contains(t)||P(t,"moveable-area")||P(t,"moveable-padding")}var i=n.controlBox.getElement(),o=[],a=n.props.dragTarget;o.push(i),n.props.dragArea&&!a||o.push(t);return ra(n,o,"targetAbles",e,{dragStart:r,pinchStart:r})}function ra(i,t,o,a,s){void 0===s&&(s={});var e="targetAbles"===o,n=i.props,r=n.pinchOutside,u=n.pinchThreshold,c=n.preventClickEventOnDrag,l=n.preventClickDefault,n=n.checkInput,u={preventDefault:!0,preventRightClick:!0,preventWheelClick:!0,container:window,pinchThreshold:u,pinchOutside:r,preventClickEventOnDrag:e&&c,preventClickEventOnDragStart:e&&l,preventClickEventByCondition:e?null:function(t){return i.controlBox.getElement().contains(t.target)},checkInput:e&&n},f=new cn(t,u),p="Control"===a;return["drag","pinch"].forEach(function(r){["Start","","End"].forEach(function(n){f.on("".concat(r).concat(n),function(t){var e=t.eventType;(!s[e]||s[e](t))&&ea(i,o,r,a,n,t)?(i.props.stopPropagation||"Start"===n&&p)&&null!=(e=null==t?void 0:t.inputEvent)&&e.stopPropagation():t.stop()})})}),f}var ia=function(){function t(t,e,n){var i=this;this.target=t,this.moveable=e,this.eventName=n,this.ables=[],this._onEvent=function(e){var n=i.eventName,r=i.moveable;r.state.disableNativeEvent||i.ables.forEach(function(t){t[n](r,{inputEvent:e})})},t.addEventListener(n.toLowerCase(),this._onEvent)}var e=t.prototype;return e.setAbles=function(t){this.ables=t},e.destroy=function(){this.target.removeEventListener(this.eventName.toLowerCase(),this._onEvent),this.target=null,this.moveable=null},t}();function oa(t,e,n){for(var r,i,o,a,s=t,u=[],c=!n&&t===e||t===document.body,l=c,f=!1,p=3,A=!1,d=vr(e,e,!0).offsetParent;s&&!l;){var l=c,h=getComputedStyle(s),g=h.position,v=gr(s,h),m=(v=(v=v)&&"none"!==v?ot(v)?v:Pe(v):[1,0,0,1,0,0],(m=(m=void 0)===m?6===v.length:m)?[v[0],v[1],0,v[2],v[3],0,v[4],v[5],1]:v),v="fixed"===g,b={hasTransform:!1,fixedContainer:null},x=(v&&(A=!0,d=(b=function(t){for(var e=t.parentElement,n=!1;e;){var r=jr(e).transform;if(r&&"none"!==r){n=!0;break}if(e===document.body)break;e=e.parentElement}return{fixedContainer:e||document.body,hasTransform:n}}(s)).fixedContainer),m.length),x=(f||16!==x||(f=!0,p=4,xr(u),o=o&&ve(o,3,4)),f&&9===x&&(m=ve(m,3,4)),mr(s,t,h)),E=x.tagName,y=x.hasOffset,F=x.isSVG,S=x.origin,I=x.targetOrigin,x=x.offset,M=x[0],x=x[1],C=("svg"===E&&o&&(u.push({type:"target",target:s,matrix:(E=p,P=_=a=k=C=B=T=D=G=R=z=void 0,R=(T=yr(w=s)).width,G=T.height,D=T.clientWidth,T=T.clientHeight,B=D/R,C=T/G,k=(w=w.preserveAspectRatio.baseVal).align,w=w.meetOrSlice,a=[0,0],_=[B,C],P=[0,0],1!==k&&(z=(k-2)%3,k=Math.floor((k-2)/3),a[0]=R*z/2,a[1]=G*k/2,w=2===w?Math.max(C,B):Math.min(B,C),_[0]=w,_[1]=w,P[0]=(D-R)/2*z,P[1]=(T-G)/2*k),(B=Re(_,E))[E*(E-1)]=P[0],B[E*(E-1)+1]=P[1],pr(B,E,a))}),u.push({type:"offset",target:s,matrix:Y(p)})),void 0),w=!1,D=!1;if(v)C=b.fixedContainer,w=!0;else{var R=vr(s,e),C=R.offsetParent,w=R.isEnd,D=R.isStatic;if(Dn)if(R.parentSlotElement){for(var O=C,N=0,j=0;O&&function(t){if(t&&t.getRootNode){t=t.getRootNode();if(11===t.nodeType)return t}}(O);)N+=O.offsetLeft,j+=O.offsetTop,O=O.offsetParent;M-=N,x-=j}}!Cn||Rn||!y||F||!D||"relative"!==g&&"static"!==g||(M-=C.offsetLeft,x-=C.offsetTop,c=c||w);var _,P,B,z=0,T=0,G=0,k=0;if(v?y&&b.hasTransform&&(G=C.clientLeft,k=C.clientTop):(y&&d!==C&&(z=C.clientLeft,T=C.clientTop),y&&C===document.body&&(M+=(_=br(s,!1,h))[0],x+=_[1])),u.push({type:"target",target:s,matrix:pr(m,p,S)}),y?(B=(P=s===t)?0:s.scrollLeft,E=P?0:s.scrollTop,u.push({type:"offset",target:s,matrix:Oe([M-B+z-G,x-E+T-k],p)})):u.push({type:"offset",target:s,origin:S}),o=o||m,r=r||S,i=i||I,l||v)break;s=C,c=w,n&&s!==document.body||(l=c)}return{offsetContainer:d,matrixes:u,targetMatrix:o=o||Y(p),transformOrigin:r=r||[0,0],targetOrigin:i=i||[0,0],is3d:f,hasFixed:A}}function aa(t,e,n,r){void 0===n&&(n=e);var e=oa(t,e),i=e.matrixes,o=e.is3d,a=e.targetMatrix,s=e.transformOrigin,u=e.targetOrigin,c=e.offsetContainer,e=e.hasFixed,l=oa(c,n,!0),f=l.matrixes,p=l.is3d,l=l.offsetContainer,r=r||p||o,d=r?4:3,t="svg"!==t.tagName.toLowerCase()&&"ownerSVGElement"in t,h=Y(d),g=Y(d),v=Y(d),m=Y(d),b=i.length,p=(f.reverse(),i.reverse(),!o&&r&&(a=ve(a,3,4),xr(i)),!p&&r&&xr(f),f.forEach(function(t){g=K(g,t.matrix,d)}),n||document.body),x=(null==(n=f[0])?void 0:n.target)||vr(p,p,!0).offsetParent,E=f.slice(1).reduce(function(t,e){return K(t,e.matrix,d)},Y(d)),n=(i.forEach(function(t,e){b-2===e&&(v=h.slice()),b-1===e&&(m=h.slice()),t.matrix||(e=function(t,e,n,r,i){var o=t.target,t=t.origin,a=e.matrix,s=(e=Pr(o)).offsetWidth,u=e.offsetHeight,e=n.getBoundingClientRect(),c=[0,0];n===document.body&&(c=br(o,!0));for(var l=(o=o.getBoundingClientRect()).left-e.left+n.scrollLeft-(n.clientLeft||0)+c[0],f=o.top-e.top+n.scrollTop-(n.clientTop||0)+c[1],e=o.width,n=o.height,c=me(r,i,a),p=(o=Mr(c,s,u,r)).left,d=o.top,h=o.width,o=o.height,g=X(c,t,r),c=T(g,[p,d]),v=[l+c[0]*e/h,f+c[1]*n/o],m=[0,0],b=0;++b<10;){var x=de(i,r),x=T(X(x,v,r),X(x,g,r));m[0]=x[0],m[1]=x[1];var x=Mr(me(r,i,Oe(m,r),a),s,u,r),E=x.left-l,x=x.top-f;if(Math.abs(E)<2&&Math.abs(x)<2)break;v[0]-=E,v[1]-=x}return m.map(function(t){return Math.round(t)})}(t,i[e+1],x,d,K(E,h,d)),t.matrix=Oe(e,d)),h=K(h,t.matrix,d)}),!t&&o),a=a||Y(n?4:3),p=Er(t&&16===a.length?ve(a,4,3):a,n);return{hasFixed:e,rootMatrix:g=pe(g,d,d),beforeMatrix:v,offsetMatrix:m,allMatrix:h,targetMatrix:a,targetTransform:p,transformOrigin:s,targetOrigin:u,is3d:r,offsetContainer:c,offsetRootContainer:l}}function sa(t,e,n,r){void 0===n&&(n=e);var i=0,o=0,a=0,s={},u=Pr(t),e=(t&&(i=u.offsetWidth,o=u.offsetHeight),t&&(e=Cr((t=aa(t,e,n,r)).allMatrix,t.transformOrigin,i,o),s=A(A({},t),e),a=Br([(n=Cr(t.allMatrix,[50,50],100,100)).pos1,n.pos2],n.direction)),r?4:3);return A(A(A({width:i,height:o,rotation:a},u),{rootMatrix:Y(e),beforeMatrix:Y(e),offsetMatrix:Y(e),allMatrix:Y(e),targetMatrix:Y(e),targetTransform:"",transformOrigin:[0,0],targetOrigin:[0,0],is3d:!!r,left:0,top:0,right:0,bottom:0,origin:[0,0],pos1:[0,0],pos2:[0,0],pos3:[0,0],pos4:[0,0],direction:1,hasFixed:!1,offsetContainer:null,offsetRootContainer:null}),s)}function ua(t,e,n,r,i){var o=1,a=[0,0],s=zr(),u=zr(),c=zr(),l=zr(),n=sa(e,n,i,!0);return e&&(i=n.is3d?4:3,o=(i=Cr(n.offsetMatrix,J(n.transformOrigin,he(n.targetMatrix,i)),n.width,n.height)).direction,a=J(i.origin,[i.left-n.left,i.top-n.top]),s=Tr(e),c=Tr(vr(r,r,!0).offsetParent||n.offsetRootContainer,!0),l=Tr(n.offsetRootContainer),t&&(u=Tr(t))),A({targetClientRect:s,containerClientRect:c,moveableClientRect:u,rootContainerClientRect:l,beforeDirection:o,beforeOrigin:a,originalBeforeOrigin:a,target:e},n)}var ca=function(t){function e(){var e=null!==t&&t.apply(this,arguments)||this;return e.state=A({container:null,gestos:{},renderPoses:[[0,0],[0,0],[0,0],[0,0]],disableNativeEvent:!1},ua(null)),e.renderState={},e.enabledAbles=[],e.targetAbles=[],e.controlAbles=[],e.rotation=0,e.scale=[1,1],e.isUnmounted=!1,e.events={mouseEnter:null,mouseLeave:null},e._emitter=new Ve,e._prevTarget=null,e._prevDragArea=!1,e._isPropTargetChanged=!1,e._observer=null,e._observerId=0,e.checkUpdateRect=function(){var t;e.isDragging()||((t=e.props.parentMoveable)?t.checkUpdateRect():(Et(e._observerId),e._observerId=xt(function(){e.isDragging()||e.updateRect()})))},e._onPreventClick=function(t){t.stopPropagation(),t.preventDefault()},e}xn(e,t);var n=e.prototype;return n.render=function(){var t=this.props,e=this.state,n=t.parentPosition,r=t.className,i=t.target,o=t.zoom,a=t.cspNonce,s=t.translateZ,u=t.cssStyled,c=t.portalContainer,n=(this.checkUpdate(),this.updateRenderPoses(),n||[0,0]),l=n[0],n=n[1],f=e.left,p=e.top,d=e.target,h=e.direction,e=e.hasFixed,t=t.targets,t=(t&&t.length||i)&&d,i=this.isDragging(),g={};return this.getEnabledAbles().forEach(function(t){g["data-able-".concat(t.name.toLowerCase())]=!0}),x(u,A({cspNonce:a,ref:S(this,"controlBox"),className:"".concat(G("control-box",-1===h?"reverse":"",i?"dragging":"")," ").concat(r)},g,{onClick:this._onPreventClick,portalContainer:c,style:{position:e?"fixed":"absolute",display:t?"block":"none",transform:"translate3d(".concat(f-l,"px, ").concat(p-n,"px, ").concat(s,")"),"--zoom":o,"--zoompx":"".concat(o,"px")}}),this.renderAbles(),this._renderLines())},n.componentDidMount=function(){this.isUnmounted=!1,this.controlBox.getElement();var t=this.props,e=t.parentMoveable,n=t.container,t=t.wrapperMoveable;this._updateTargets(),this._updateNativeEvents(),this._updateEvents(),n||e||t||this.updateRect("",!1,!0),this.updateCheckInput(),this._updateObserver(this.props)},n.componentDidUpdate=function(t){this._updateNativeEvents(),this._updateEvents(),this._updateTargets(),this.updateCheckInput(),this._updateObserver(t)},n.componentWillUnmount=function(){this.isUnmounted=!0,this._emitter.off(),Ar(this,"targetGesto"),Ar(this,"controlGesto");var t,e=this.events;for(t in e){var n=e[t];n&&n.destroy()}},n.getAble=function(e){return bt(this.props.ables||[],function(t){return t.name===e})},n.getContainer=function(){var t=this.props,e=t.parentMoveable,n=t.wrapperMoveable;return t.container||n&&n.getContainer()||e&&e.getContainer()||this.controlBox.getElement().parentElement},n.isMoveableElement=function(t){var e;return t&&-1<((null==(e=t.getAttribute)?void 0:e.call(t,"class"))||"").indexOf(On)},n.dragStart=function(t){var e=this.targetGesto;return e&&!e.isFlag()&&e.triggerDragStart(t),this},n.hitTest=function(t){var e=this.state,n=e.target,r=e.pos1,i=e.pos2,o=e.pos3,a=e.pos4,e=e.targetClientRect;if(!n)return 0;var t=(n=t instanceof Element?{left:(n=t.getBoundingClientRect()).left,top:n.top,width:n.width,height:n.height}:A({width:0,height:0},t)).left,s=n.top,u=n.width,n=n.height,r=Ie([r,i,a,o],e),i=Fe(Le(r,[[t,s],[t+u,s],[t+u,s+n],[t,s+n]])),a=Fe(r);return i&&a?Math.min(100,i/a*100):0},n.isInside=function(t,e){var n=this.state,r=n.target,i=n.pos1,o=n.pos2,a=n.pos3,s=n.pos4,n=n.targetClientRect;return!!r&&je([t,e],Ie([i,o,s,a],n))},n.updateRect=function(t,e,n){void 0===n&&(n=!0);var r=this.props,i=r.parentMoveable,o=this.state.target||this.props.target,a=this.getContainer(),r=(i?i.props:r).rootContainer;this.updateState(ua(this.controlBox&&this.controlBox.getElement(),o,a,a,r||a),!i&&n)},n.isDragging=function(){return!!this.targetGesto&&this.targetGesto.isFlag()||!!this.controlGesto&&this.controlGesto.isFlag()},n.updateTarget=function(t){this.updateRect(t,!0)},n.getRect=function(){var t=this.state,e=W(this.state),n=e[0],r=e[1],i=e[2],o=e[3],e=tt(e),a=t.width,s=t.height,u=e.width,c=e.height,l=e.left,e=e.top,f=[t.left,t.top],p=J(f,t.origin);return{width:u,height:c,left:l,top:e,pos1:n,pos2:r,pos3:i,pos4:o,offsetWidth:a,offsetHeight:s,beforeOrigin:J(f,t.beforeOrigin),origin:p,transformOrigin:t.transformOrigin,rotation:this.getRotation()}},n.getManager=function(){return this},n.getRotation=function(){var t=this.state,e=t.pos1,n=t.pos2,t=t.direction;return t=t,e=I(e=e,n)/Math.PI*180,e=0<=(e=0<=t?e:180-e)?e:360+e},n.request=function(e,t,n){void 0===t&&(t={});var r=this.props,i=r.ables,r=r.groupable,i=i.filter(function(t){return t.name===e})[0];if(this.isDragging()||!i||!i.request)return{request:function(){return this},requestEnd:function(){return this}};var o=this,a=i.request(this),s=n||t.isInstant,u=a.isControl?"controlAbles":"targetAbles",c="".concat(r?"Group":"").concat(a.isControl?"Control":""),i={request:function(t){return ea(o,u,"drag",c,"",A(A({},a.request(t)),{requestAble:e,isRequest:!0}),s),this},requestEnd:function(){return ea(o,u,"drag",c,"End",A(A({},a.requestEnd()),{requestAble:e,isRequest:!0}),s),this}};return ea(o,u,"drag",c,"Start",A(A({},a.requestStart(t)),{requestAble:e,isRequest:!0}),s),s?i.request(t).requestEnd():i},n.destroy=function(){this.componentWillUnmount()},n.updateRenderPoses=function(){var t=this.state,e=this.props,n=t.originalBeforeOrigin,r=t.transformOrigin,i=t.allMatrix,o=t.is3d,a=t.pos1,s=t.pos2,u=t.pos3,c=t.pos4,l=t.left,f=t.top,p=e.padding||{},d=p.left,d=void 0===d?0:d,h=p.top,h=void 0===h?0:h,g=p.bottom,g=void 0===g?0:g,p=p.right,p=void 0===p?0:p,o=o?4:3,e=e.groupable?n:J(n,[l,f]);t.renderPoses=[J(a,Vr(i,[-d,-h],r,e,o)),J(s,Vr(i,[p,-h],r,e,o)),J(u,Vr(i,[-d,g],r,e,o)),J(c,Vr(i,[p,g],r,e,o))]},n.checkUpdate=function(){this._isPropTargetChanged=!1;var t=this.props,e=t.target,n=t.container,t=t.parentMoveable,r=this.state,i=r.target,r=r.container;(i||e)&&(this.updateAbles(),!(i=!Xr(i,e))&&Xr(r,n)||((r=n||this.controlBox)&&this.unsetAbles(),this.updateState({target:e,container:n}),!t&&r&&this.updateRect("End",!1,!1),this._isPropTargetChanged=i))},n.waitToChangeTarget=function(){return new Promise(function(){})},n.triggerEvent=function(t,e){this._emitter.trigger(t,e);t=this.props[t];return t&&t(e)},n.useCSS=function(t,e){var n=this.props.customStyledMap,r=t+e;return n[r]||(n[r]=mn(t,e)),n[r]},n.updateSelectors=function(){},n.unsetAbles=function(){var e=this;this.targetAbles.forEach(function(t){t.unset&&t.unset(e)})},n.updateAbles=function(t,e){void 0===t&&(t=this.props.ables),void 0===e&&(e="");var n=this.props,r=n.triggerAblesSimultaneously,t=t.filter(function(t){return t&&(t.always&&!1!==n[t.name]||n[t.name])}),i="drag".concat(e,"Start"),o="pinch".concat(e,"Start"),e="drag".concat(e,"ControlStart"),i=Yr(t,[i,o],r),o=Yr(t,[e],r);this.enabledAbles=t,this.targetAbles=i,this.controlAbles=o},n.updateState=function(t,e){if(e)this.isUnmounted||this.setState(t);else{var n,r=this.state;for(n in t)r[n]=t[n]}},n.getEnabledAbles=function(){var e=this.props;return e.ables.filter(function(t){return t&&e[t.name]})},n.renderAbles=function(){var r,i,o,a,e=this,t=this.props.triggerAblesSimultaneously,n={createElement:x};return this.renderState={},r=Wr(Yr(this.getEnabledAbles(),["render"],t).map(function(t){return(0,t.render)(e,n)||[]})).filter(function(t){return t}),i=function(t){return t.key},o=[],a={},r.forEach(function(t,e){var e=i(t,e,r),n=a[e];n||(a[e]=n=[],o.push(n)),n.push(t)}),o.map(function(t){return t[0]})},n.updateCheckInput=function(){this.targetGesto&&(this.targetGesto.options.checkInput=this.props.checkInput)},n._updateObserver=function(t){var e=this.props,n=e.target;window.ResizeObserver&&n&&e.useResizeObserver?t.target===n&&this._observer||((e=new ResizeObserver(this.checkUpdateRect)).observe(n,{box:"border-box"}),this._observer=e):null!=(t=this._observer)&&t.disconnect()},n._updateEvents=function(){var t=this.controlBox.getElement(),e=this.targetAbles.length,n=this.controlAbles.length,r=this.props,r=r.dragTarget||r.target;(!e&&this.targetGesto||this._isTargetChanged(!0))&&(Ar(this,"targetGesto"),this.updateState({gesto:null})),n||Ar(this,"controlGesto"),r&&e&&!this.targetGesto&&(this.targetGesto=na(this,r,"")),!this.controlGesto&&n&&(this.controlGesto=ra(this,t,"controlAbles","Control"))},n._updateTargets=function(){var t=this.props;this._prevTarget=t.dragTarget||t.target,this._prevDragArea=t.dragArea},n._renderLines=function(){var t=this.props,r=t.zoom,e=t.hideDefaultLines,n=t.hideChildMoveableDefaultLines,t=t.parentMoveable;if(e||t&&n)return[];var i=this.state.renderPoses,o={createElement:x};return[[0,1],[1,3],[3,2],[2,0]].map(function(t,e){var n=t[0],t=t[1];return so(o,"",i[n],i[t],r,"render-line-".concat(e))})},n._isTargetChanged=function(t){var e=this.props,n=e.dragTarget||e.target,r=this._prevTarget,i=this._prevDragArea,e=e.dragArea;return!e&&r!==n||(t||e)&&i!==e},n._updateNativeEvents=function(){var i,o=this,a=this.props.dragArea?this.areaElement:this.state.target,s=this.events,t=yt(s);if(this._isTargetChanged())for(var e in s){var n=s[e];n&&n.destroy(),s[e]=null}a&&(i=this.enabledAbles,t.forEach(function(t){var e=Yr(i,[t]),n=0<e.length,r=s[t];n?(r||(r=new ia(a,o,t),s[t]=r),r.setAbles(e)):r&&(r.destroy(),s[t]=null)}))},e.defaultProps={target:null,dragTarget:null,container:null,rootContainer:null,origin:!0,parentMoveable:null,wrapperMoveable:null,parentPosition:null,portalContainer:null,useResizeObserver:!1,ables:[],pinchThreshold:20,dragArea:!1,passDragArea:!1,transformOrigin:"",className:"",zoom:1,triggerAblesSimultaneously:!1,padding:{},pinchOutside:!0,checkInput:!1,groupable:!1,hideDefaultLines:!1,cspNonce:"",translateZ:0,cssStyled:null,customStyledMap:{},props:{},stopPropagation:!1,preventClickDefault:!1,preventClickEventOnDrag:!0,flushSync:fr},e}(Vt),la={name:"groupable",props:{defaultGroupRotate:Number,defaultGroupOrigin:String,groupable:Boolean,targetGroups:Object,hideChildMoveableDefaultLines:Boolean},events:{},render:function(n,o){var t=n.props.targets||[],e=(n.moveables=[],n.state),a=[e.left,e.top],r=n.props,s=r.zoom||1,e=n.renderGroupRects;return Q(Q([],t.map(function(t,e){return o.createElement(ca,{key:"moveable"+e,ref:c(n,"moveables",e),target:t,origin:!1,cssStyled:r.cssStyled,customStyledMap:r.customStyledMap,useResizeObserver:r.useResizeObserver,hideChildMoveableDefaultLines:r.hideChildMoveableDefaultLines,parentMoveable:n,parentPosition:a,zoom:s})}),!0),Wr(e.map(function(t,r){var i=[t.pos1,t.pos2,t.pos3,t.pos4];return[[0,1],[1,3],[3,2],[2,0]].map(function(t,e){var n=t[0],t=t[1];return so(o,"",T(i[n],a),T(i[t],a),s,"group-rect-".concat(r,"-").concat(e))})})),!0)}},fa=En("clickable",{props:{clickable:Boolean},events:{onClick:"click",onClickGroup:"clickGroup"},always:!0,dragRelation:"weak",dragStart:function(){},dragControlStart:function(){},dragGroupStart:function(t,e){e.datas.inputTarget=e.inputEvent&&e.inputEvent.target},dragEnd:function(t,e){var n=t.props.target,r=e.inputEvent,i=e.inputTarget,o=!t.isMoveableElement(i)&&t.controlBox.getElement().contains(i);!r||!i||e.isDrag||t.isMoveableElement(i)||o||(r=n.contains(i),nt(t,"onClick",et(t,e,{isDouble:e.isDouble,inputTarget:i,isTarget:n===i,moveableTarget:t.props.target,containsTarget:r})))},dragGroupEnd:function(t,e){var n,r,i,o=e.inputEvent,a=e.inputTarget;o&&a&&!e.isDrag&&!t.isMoveableElement(a)&&e.datas.inputTarget!==a&&(r=-1<(n=(o=t.props.targets).indexOf(a)),i=!1,-1===n&&(i=-1<(n=mt(o,function(t){return t.contains(a)}))),nt(t,"onClickGroup",et(t,e,{isDouble:e.isDouble,targets:o,inputTarget:a,targetIndex:n,isTarget:r,containsTarget:i,moveableTarget:o[n]})))},dragControlEnd:function(t,e){this.dragEnd(t,e)},dragGroupControlEnd:function(t,e){this.dragEnd(t,e)}});function pa(t){var e=t.originalDatas.draggable;return e||(t.originalDatas.draggable={},e=t.originalDatas.draggable),A(A({},t),{datas:e})}var da=En("edgeDraggable",{css:[".edge.edgeDraggable.line {\n    cursor: move;\n}"],render:function(t,e){var n=t.props,r=n.edgeDraggable;return r?uo(e,"edgeDraggable",r,t.state.renderPoses,n.zoom):[]},dragControlCondition:function(t,e){if(!t.props.edgeDraggable||!e.inputEvent)return!1;t=e.inputEvent.target;return P(t,G("direction"))&&P(t,G("edge"))&&P(t,G("edgeDraggable"))},dragControlStart:function(t,e){return t.state.snapRenderInfo={request:e.isRequest,snap:!0,center:!0},q.dragStart(t,pa(e))},dragControl:function(t,e){return q.drag(t,pa(e))},dragControlEnd:function(t,e){return q.dragEnd(t,pa(e))},dragGroupControlCondition:function(t,e){if(!t.props.edgeDraggable||!e.inputEvent)return!1;t=e.inputEvent.target;return P(t,G("direction"))&&P(t,G("line"))},dragGroupControlStart:function(t,e){return q.dragGroupStart(t,pa(e))},dragGroupControl:function(t,e){return q.dragGroup(t,pa(e))},dragGroupControlEnd:function(t,e){return q.dragGroupEnd(t,pa(e))},unset:function(t){return q.unset(t)}}),ha={name:"individualGroupable",props:{individualGroupable:Boolean},events:{}},ga=[Qo,Oo,t,ue,q,da,fo,d,bo,se,le,_o,o,$o,Uo,Jo,la,ha,fa,Do,ta],t=ga.reduce(function(t,e){return A(A({},t),"events"in e?e.events:{})},{}),ue=ga.reduce(function(t,e){return A(A({},t),e.props)},{}),da=Object.keys(Kr(t)),d=Object.keys(ue);function va(t,e){var n=t[0],r=t[1],t=t[2];return(n*e[0]+r*e[1]+t)/Math.sqrt(n*n+r*r)}function ma(t,e){var n=t[0],t=t[1];return-n*e[0]-t*e[1]}function ba(t,i){return Math.max.apply(Math,t.map(function(t){var e=t[0],n=t[1],r=t[2],t=t[3];return Math.max(e[i],n[i],r[i],t[i])}))}function xa(t,i){return Math.min.apply(Math,t.map(function(t){var e=t[0],n=t[1],r=t[2],t=t[3];return Math.min(e[i],n[i],r[i],t[i])}))}var Ea=function(r){function t(){var t=null!==r&&r.apply(this,arguments)||this;return t.differ=new Ae,t.moveables=[],t.transformOrigin="50% 50%",t.renderGroupRects=[],t}xn(t,r);var e=t.prototype;return e.checkUpdate=function(){this._isPropTargetChanged=!1,this.updateAbles()},e.updateRect=function(e,t,n){var r,M,i,C,w,o,a,s,u,c,l,f,p,d,h;void 0===n&&(n=!0),this.controlBox&&(this.moveables.forEach(function(t){t.updateRect(e,!1,!1)}),r=this.state,M=this.props,s=this.moveables,i=r.target||M.target,(o=function r(i,t){t=t.map(function(e){var t,n;return D(e)?1<(n=(t=r(i,e)).length)?t:1===n?t[0]:null:(n=bt(i,function(t){return t.manager.props.target===e}))?(n.finded=!0,n.manager):null}).filter(Boolean);return 1===t.length&&D(t[0])?t[0]:t}(s=s.map(function(t){return{finded:!1,manager:t}}),this.props.targetGroups||[])).push.apply(o,s.filter(function(t){return!t.finded}).map(function(t){return t.manager})),C=[],w=!t||""!==e&&M.updateGroup,s=function r(t,i,e){var t=t.map(function(t){var e,n;return D(t)?(n=[(e=r(t,i)).pos1,e.pos2,e.pos3,e.pos4],C.push(e),{poses:n,rotation:e.rotation}):{poses:W(t.state),rotation:t.getRotation()}}),n=t.map(function(t){return t.rotation}),o=0,a=n[0],n=n.every(function(t){return Math.abs(a-t)<.1}),o=w?n?a:M.defaultGroupRotate||0:!e&&n?a:i,e=t.map(function(t){return t.poses}),n=o,t=[0,0],o=[0,0],s=[0,0],u=[0,0],c=0,l=0;if(!e.length)return{pos1:t,pos2:o,pos3:s,pos4:u,minX:0,minY:0,width:c,height:l,rotation:n};var f,p,d,h,g,v,m,b,x,E,y,S=N(n,F),e=(S%90?(x=S/180*Math.PI,f=Math.tan(x),p=-1/f,d=[zn,Tn],h=[[0,0],[0,0]],g=[zn,Tn],v=[[0,0],[0,0]],e.forEach(function(t){t.forEach(function(t){var e=va([-f,1,0],t),n=va([-p,1,0],t);d[0]>e&&(h[0]=t,d[0]=e),d[1]<e&&(h[1]=t,d[1]=e),g[0]>n&&(v[0]=t,g[0]=n),g[1]<n&&(v[1]=t,g[1]=n)})}),x=h[0],b=h[1],m=v[0],E=v[1],x=[-f,1,ma([-f,1],x)],b=[-f,1,ma([-f,1],b)],t=(E=[[x,m=[-p,1,ma([-p,1],m)]],[x,x=[-p,1,ma([-p,1],E)]],[b,m],[b,x]].map(function(t){return Xe(t[0],t[1])[0]}))[0],o=E[1],s=E[2],u=E[3],c=g[1]-g[0],l=d[1]-d[0]):(t=[m=xa(e,0),b=xa(e,1)],o=[x=ba(e,0),b],s=[m,E=ba(e,1)],u=[x,E],c=x-m,l=E-b,S%180&&(t=(y=[s,t,u,o])[0],o=y[1],s=y[2],u=y[3],c=E-b,l=x-m)),180<S%360&&(t=(y=[u,s,o,t])[0],o=y[1],s=y[2],u=y[3]),Ne([t,o,s,u]));return{pos1:t,pos2:o,pos3:s,pos4:u,width:c,height:l,minX:e.minX,minY:e.minY,rotation:n}}(o,this.rotation,!0),w&&(this.rotation=s.rotation,this.transformOrigin=M.defaultGroupOrigin||"50% 50%",this.scale=[1,1]),this.renderGroupRects=C,t=this.rotation,o=this.scale,c=s.width,u=s.height,a=s.minX,s=s.minY,t="rotate(".concat(t,"deg) scale(").concat(0<=o[0]?1:-1,", ").concat(0<=o[1]?1:-1,")"),i.style.cssText+="left:0px;top:0px; transform-origin: ".concat(this.transformOrigin,"; width:").concat(c,"px; height:").concat(u,"px;")+"transform:".concat(t),r.width=c,r.height=u,c=this.getContainer(),c=[(u=ua(this.controlBox.getElement(),i,this.controlBox.getElement(),this.getContainer(),this.props.rootContainer||c)).left,u.top],p=[(p=Ne([d=(f=W(u))[0],h=f[1],l=f[2],f=f[3]])).minX,p.minY],u.pos1=T(d,p),u.pos2=T(h,p),u.pos3=T(l,p),u.pos4=T(f,p),u.left=a-u.left+p[0],u.top=s-u.top+p[1],u.origin=T(J(c,u.origin),p),u.beforeOrigin=T(J(c,u.beforeOrigin),p),u.originalBeforeOrigin=J(c,u.originalBeforeOrigin),d=u.targetClientRect,h=0<o[0]*o[1]?1:-1,d.top+=u.top-r.top,d.left+=u.left-r.left,i.style.transform="translate(".concat(-p[0],"px, ").concat(-p[1],"px) ").concat(t),this.updateState(A(A({},u),{direction:h,beforeDirection:h}),n))},e.getRect=function(){return A(A({},r.prototype.getRect.call(this)),{children:this.moveables.map(function(t){return t.getRect()})})},e.triggerEvent=function(t,e,n){if(n||-1<t.indexOf("Group"))return r.prototype.triggerEvent.call(this,t,e);this._emitter.trigger(t,e)},e.updateAbles=function(){r.prototype.updateAbles.call(this,Q(Q([],this.props.ables,!0),[la],!1),"Group")},e._updateTargets=function(){r.prototype._updateTargets.call(this),this._prevTarget=this.props.dragTarget||this.areaElement},e._updateEvents=function(){var t=this.state,e=this.props,n=this._prevTarget,r=e.dragTarget||this.areaElement,n=(n!==r&&(Ar(this,"targetGesto"),Ar(this,"controlGesto"),t.target=null),t.target||(t.target=this.areaElement,this.controlBox.getElement().style.display="block"),t.target&&(this.targetGesto||(this.targetGesto=na(this,r,"Group")),this.controlGesto||(this.controlGesto=ra(this,this.controlBox.getElement(),"controlAbles","GroupControl"))),!Xr(t.container,e.container)),r=(n&&(t.container=e.container),this.differ.update(e.targets)),t=r.added,e=r.changed,r=r.removed,t=t.length||r.length;(n||t||e.length)&&this.updateRect(),this._isPropTargetChanged=!!t},e._updateObserver=function(){},t.defaultProps=A(A({},ca.defaultProps),{transformOrigin:["50%","50%"],groupable:!0,dragArea:!0,keepRatio:!0,targets:[],defaultGroupRotate:0,defaultGroupOrigin:"50% 50%"}),t}(ca),ya=function(e){function t(){var t=null!==e&&e.apply(this,arguments)||this;return t.moveables=[],t}xn(t,e);var n=t.prototype;return n.render=function(){var n=this,t=this.props,e=t.cspNonce,r=t.cssStyled,t=t.targets;return x(r,{cspNonce:e,ref:S(this,"controlBox"),className:G("control-box")},t.map(function(t,e){return x(ca,A({key:"moveable"+e,ref:c(n,"moveables",e)},n.props,{target:t,wrapperMoveable:n}))}))},n.componentDidUpdate=function(){},n.updateRect=function(e,n,r){void 0===r&&(r=!0),this.moveables.forEach(function(t){t.updateRect(e,n,r)})},n.getRect=function(){return A(A({},e.prototype.getRect.call(this)),{children:this.moveables.map(function(t){return t.getRect()})})},n.request=function(){return{request:function(){return this},requestEnd:function(){return this}}},n.dragStart=function(){return this},n.hitTest=function(){return 0},n.isInside=function(){return!1},n.isDragging=function(){return!1},n.updateRenderPoses=function(){},n.checkUpdate=function(){},n.triggerEvent=function(){},n.updateAbles=function(){},n._updateEvents=function(){},n._updateObserver=function(){},t}(ca);var Sa=function(t){function e(){return null!==t&&t.apply(this,arguments)||this}return xn(e,t),e.defaultAbles=ga,e}(function(e){function t(){var t=null!==e&&e.apply(this,arguments)||this;return t.refTargets=[],t.selectorMap={},t._differ=new Ae,t._elementTargets=[],t._onChangetarget=null,t}xn(t,e);var n,o,r=t.prototype;return t.makeStyled=function(){var n,e={},t=(this.getTotalAbles().forEach(function(t){t=t.css;t&&t.forEach(function(t){e[t]=!0})}),yt(e).join("\n"));this.defaultStyled=mn("div",(n=On,(_n+t).replace(/([^}{]*){/gm,function(t,e){return e.replace(/\.([^{,\s\d.]+)/g,"."+n+"$1")+"{"})))},t.getTotalAbles=function(){return Q([Oo,la,ha,Do],this.defaultAbles,!0)},r.render=function(){var t=this.constructor,e=(t.defaultStyled||t.makeStyled(),this.props),n=e.ables,r=e.props,e=function(t,e){var n={};for(i in t)Object.prototype.hasOwnProperty.call(t,i)&&e.indexOf(i)<0&&(n[i]=t[i]);if(null!=t&&"function"==typeof Object.getOwnPropertySymbols)for(var r=0,i=Object.getOwnPropertySymbols(t);r<i.length;r++)e.indexOf(i[r])<0&&Object.prototype.propertyIsEnumerable.call(t,i[r])&&(n[i[r]]=t[i[r]]);return n}(e,["ables","props"]),i=this._updateRefs(!0),o=function e(t,n){var r=[];return t.forEach(function(t){t&&(b(t)?n[t]&&r.push.apply(r,n[t]):D(t)?r.push.apply(r,e(t,n)):r.push(t))}),r}(i,this.selectorMap),a=1<o.length,n=Q(Q([],t.getTotalAbles(),!0),n||[],!0),r=A(A(A({},e),r||{}),{ables:n,cssStyled:t.defaultStyled,customStyledMap:t.customStyledMap});if(this._elementTargets=o,a){if(e.individualGroupable)return x(ya,A({key:"individual-group",ref:S(this,"moveable")},r,{target:null,targets:o}));n=function e(t,n){var r=[];return t.forEach(function(t){t&&(b(t)?n[t]&&r.push.apply(r,n[t]):D(t)?r.push(e(t,n)):r.push(t))}),r}(i,this.selectorMap);return x(Ea,A({key:"group",ref:S(this,"moveable")},r,{target:null,targets:o,targetGroups:n}))}return x(ca,A({key:"single",ref:S(this,"moveable")},r,{target:o[0]}))},r.componentDidMount=function(){this._updateRefs()},r.componentDidUpdate=function(){var t=this._differ.update(this._elementTargets),e=t.added,t=t.removed;(e.length||t.length)&&this._onChangetarget&&this._onChangetarget(),this._updateRefs()},r.componentWillUnmount=function(){this.selectorMap={},this.refTargets=[]},r.updateSelectors=function(){this.selectorMap={},this.refTargets=[],this.forceUpdate()},r.waitToChangeTarget=function(){var e,t=this;return this._onChangetarget=function(){t._onChangetarget=null,e()},new Promise(function(t){e=t})},r.getManager=function(){return this.moveable},r._updateRefs=function(t){var e=this.refTargets,n=Qr(this.props.target||this.props.targets),r="undefined"!=typeof document,i=function n(t,r){return t.length!==r.length||t.some(function(t,e){return e=r[e],!(!t&&!e)&&t!=e&&(!D(t)||!D(e)||n(t,e))})}(e,n),o=this.selectorMap,a={};return this.refTargets.forEach(function t(e){b(e)?o[e]?a[e]=o[e]:r&&(i=!0,a[e]=[].slice.call(document.querySelectorAll(e))):D(e)&&e.forEach(t)}),this.refTargets=n,this.selectorMap=a,!t&&i&&this.forceUpdate(),n},t.defaultAbles=[],t.customStyledMap={},t.defaultStyled=null,function(t,e,n,r){var i,o=arguments.length,a=o<3?e:null===r?r=Object.getOwnPropertyDescriptor(e,n):r;if("object"==typeof Reflect&&"function"==typeof Reflect.decorate)a=Reflect.decorate(t,e,n,r);else for(var s=t.length-1;0<=s;s--)(i=t[s])&&(a=(o<3?i(a):3<o?i(e,n,a):i(e,n))||a);3<o&&a&&Object.defineProperty(e,n,a)}([(n=Nn,void 0===o&&(o={}),function(e,i){n.forEach(function(r){var t=o[r]||r;t in e||(e[t]=function(){for(var t=[],e=0;e<arguments.length;e++)t[e]=arguments[e];var n=(n=this[i])[r].apply(n,t);return n===this[i]?this:n})})})],t.prototype,"moveable",void 0),t}(Vt)),Ma=function(e){function t(t){t=e.call(this,t)||this;return t.state={},t.state=t.props,t}return s(t,e),t.prototype.render=function(){return t=x(Sa,u({ref:S(this,"moveable")},this.state)),e=this.state.parentElement,x(Ut,{element:t,container:e});var t,e},t}(It),Ca=d,wa=Nn,Da=da,bo=ue,Ra=function(t){function e(){return null!==t&&t.apply(this,arguments)||this}return s(e,t),e}(function(i){function t(t,e){void 0===e&&(e={});var n=i.call(this)||this,e=(n.tempElement=document.createElement("div"),u({},e)),r={},t=(Da.forEach(function(e){r["on ".concat(e).replace(/[\s-_]([a-z])/g,function(t,e){return e.toUpperCase()})]=function(t){return n.trigger(e,t)}}),Jt(x(Ma,u({ref:S(n,"innerMoveable"),parentElement:t},e,r)),n.tempElement),e.target);return D(t)&&1<t.length&&n.updateRect(),n}s(t,i);var e=t.prototype;return e.setState=function(t,e){this.innerMoveable.setState(t,e)},e.forceUpdate=function(t){this.innerMoveable.forceUpdate(t)},e.dragStart=function(t){this.innerMoveable.$_timer&&this.forceUpdate(),this.getMoveable().dragStart(t)},e.destroy=function(){Jt(null,this.tempElement),this.off(),this.tempElement=null,this.innerMoveable=null},e.getMoveable=function(){return this.innerMoveable.moveable},function(t,e,n,r){var i,o=arguments.length,a=o<3?e:null===r?r=Object.getOwnPropertyDescriptor(e,n):r;if("object"==typeof Reflect&&"function"==typeof Reflect.decorate)a=Reflect.decorate(t,e,n,r);else for(var s=t.length-1;0<=s;s--)(i=t[s])&&(a=(o<3?i(a):3<o?i(e,n,a):i(e,n))||a);return 3<o&&a&&Object.defineProperty(e,n,a),a}([l(wa,function(t,r){t[r]||(t[r]=function(){for(var t=[],e=0;e<arguments.length;e++)t[e]=arguments[e];var n=this.getMoveable();if(n&&n[r])return n[r].apply(n,t)})}),l(Ca,function(t,n){Object.defineProperty(t,n,{get:function(){return this.getMoveable().props[n]},set:function(t){var e;this.setState(((e={})[n]=t,e))},enumerable:!0,configurable:!0})})],t)}(Ve));var Oa,_a={__proto__:null,default:Ra,PROPERTIES:Ca,METHODS:wa,EVENTS:Da,PROPS_MAP:bo,getElementInfo:function(t,e,n){return sa(t,t=e,e=void 0===(e=n)?t:e,!0)},makeAble:En};for(Oa in _a)Ra[Oa]=_a[Oa];return Ra});
//# sourceMappingURL=moveable.min.js.map

/**
 * @author: Zhang Dong
 * @version: v1.0.1
 */

;(function ($) {
    var _keyCodes = {
        ESC: 27,
        TAB: 9,
        RETURN: 13,
        LEFT: 37,
        UP: 38,
        RIGHT: 39,
        DOWN: 40,
        ENTER: 13,
        SHIFT: 16
    }

    function ZdCascader (el, options) {
        this.options = options
        if (options.search) this.getLabelList()
        this.CLASS = ZdCascader.CLASS
        this.$el = $(el) //input
        this.$el_ = this.$el.clone()

        this.init()
    }
    ZdCascader.CLASS = {
        wrap: 'zd-cascader-wrap',
        inputwrap: 'zd-input zd-input--suffix',
        input: 'zd-input__inner',
        iconWrap: 'zd-input__suffix',
        iconInnerWrap: 'zd-input__suffix-inner',
        icon: 'icon zd-input__icon zd-icon-arrow-down',
        dropdownWrap: 'zd-cascader__dropdown',
        dropdownPanel: 'zd-cascader-panel',
        menuWrap: 'zd-cascader-menu',
        menuList: 'zd-cascader-menu__list',
        menuNode: 'zd-cascader-node',
        menuNodeLabel: 'zd-cascader-node__label',
        menuNodePostfix: 'zd-cascader-node__postfix',
        checkClass: {
            wrapFocus: 'is-focus',
            menuNodeSelected: 'in-active-path',
            nodeSelectedIcon: 'is-selected-icon',
            nodeAnchor: 'is-prepare' //预备选中
        }
    }
    ZdCascader.DEFAULTS = {
        data: null, //支持格式[{value:"",label:"",children:[{value:"",label:""}]}]
        range: ' / ', //分割符
        onChange: function (data) {}
    }

    ZdCascader.METHODS = ['reload', 'destroy']

    ZdCascader.prototype.init = function () {
        /*构建基础html*/
        this._construct()
        /*事件绑定*/
        this._event()
    }

    //构建Cascader的html
    ZdCascader.prototype._construct = function () {
        var self = this
        //最外层容器
        this.$container = this.$el
            .wrap(`<div class="${this.CLASS.wrap}"></div>`)
            .wrap(`<div class="${this.CLASS.inputwrap}"></div>`)
            .addClass(this.CLASS.input)
            .prop('readonly', !this.options.search)
            .closest('.' + this.CLASS.wrap)

        //文本框右侧图标
        this.$arrow = $(`<span class="zd-input__suffix">
                                    <span class="zd-input__suffix-inner">
                                        <svg t="1600158452164" class="icon zd-input__icon zd-icon-arrow-down" viewBox="0 0 1024 1024"
                                            version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1181" width="200" height="200">
                                            <path
                                                d="M538.434046 617.504916c0 3.687996-1.403976 7.356548-4.211928 10.1645-5.615904 5.615904-14.713097 5.615904-20.329001 0L364.187513 476.931297c-5.615904-5.615904-5.615904-14.713097 0-20.329001 5.615904-5.615904 14.713097-5.615904 20.329001 0l149.705604 150.739143C537.03007 610.148367 538.434046 613.817943 538.434046 617.504916z"
                                                p-id="1182" fill="#515151"></path>
                                            <path
                                                d="M689.172165 466.767819c0 3.687996-1.403976 7.356548-4.211928 10.1645L534.222117 627.670439c-5.615904 5.615904-14.713097 5.615904-20.329001 0-5.615904-5.615904-5.615904-14.713097 0-20.329001L664.631236 456.603319c5.615904-5.615904 14.713097-5.615904 20.329001 0C687.768189 459.411271 689.172165 463.079824 689.172165 466.767819z"
                                                p-id="1183" fill="#515151"></path>
                                        </svg>
                                    </span>
                                </span>`).insertAfter(this.$el)
        //下拉列表
        this.$dropdownWrap = $(
            `<div class="${this.CLASS.dropdownPanel}"></div>`
        )
            .appendTo(this.$container)
            .wrap(`<div class="${this.CLASS.dropdownWrap}"></div>`)

        this.reload()
    }

    /*事件绑定*/
    ZdCascader.prototype._event = function () {
        this.$container.on('click.wrap', $.proxy(this._wrapClick, this))
        this.$container.on(
            'mousedown',
            $.proxy(function (event) {
                this.$el.focus()
                event.stopPropagation()
            }, this)
        )
        $(document).on(
            'mousedown.cascader',
            $.proxy(function () {
                this.$container.removeClass(this.CLASS.checkClass.wrapFocus)
            }, this)
        )

        this.$container.on(
            'blur.wrap',
            $.proxy(function () {
                this.$container.removeClass(this.CLASS.checkClass.wrapFocus)
            }, this)
        )

        this.$container.on(
            'click.item',
            '.' + this.CLASS.menuNode,
            $.proxy(this._nodeClick, this)
        )

        this.$el.on('keyup.wrap', $.proxy(this._keyup, this))

        this.$el.on(
            'input',
            $.proxy(function (event) {
                this.search(this.$el.val())
            }, this)
        )
    }
    ZdCascader.prototype._wrapClick = function () {
        event.stopPropagation()
        this.$el.focus()
        if (!this.$container.hasClass(this.CLASS.checkClass.wrapFocus)) {
            // if (this.$dropdownWrap.children(this.CLASS.menuWrap).length === 0)
            //     loadFirst();
            this.$container.addClass(this.CLASS.checkClass.wrapFocus)
        }
        this.$dropdownWrap
            .find('li.' + this.CLASS.checkClass.nodeAnchor)
            .removeClass(this.CLASS.checkClass.nodeAnchor)
        this.$dropdownWrap
            .find(this.CLASS.menuList)
            .eq(0)
            .find('li.' + this.CLASS.checkClass.menuNodeSelected)
            .addClass(this.CLASS.checkClass.nodeAnchor)
    }
    ZdCascader.prototype._nodeClick = function (event) {
        var $that = event.currentTarget ? $(event.currentTarget) : $(event) //li
        var $wrap = $that.closest('.' + this.CLASS.menuWrap)
        $that
            .addClass(this.CLASS.checkClass.menuNodeSelected)
            .siblings()
            .removeClass(this.CLASS.checkClass.menuNodeSelected)
        var data = $that.data('bindData')
        if (!data.children) {
            $wrap.nextAll().remove()
            var prevWrap = $wrap.prevAll()
            var value = data.label
            var allPathData = [data]
            $.each(prevWrap, (i, m) => {
                var selectedData = $(m)
                    .find('li.' + this.CLASS.checkClass.menuNodeSelected)
                    .data('bindData')
                value = selectedData.label + this.options.range + value
                allPathData.push(selectedData)
            })
            this.$el.val(value).focus()
            this.$container.removeClass(this.CLASS.checkClass.wrapFocus)
            this.$dropdownWrap
                .find('.' + this.CLASS.checkClass.nodeSelectedIcon)
                .remove()
            // $that.prepend($(`<span class="${this.CLASS.checkClass.nodeSelectedIcon}">√</span>`));
            this.$el.data('bindData', data)
            this.$el.data('bindPathData', allPathData)
            if (
                this.options.onChange &&
                typeof this.options.onChange === 'function'
            )
                this.options.onChange(this, data, allPathData)
            event.stopPropagation()
        } else this._loadChildren($that)
    }
    ZdCascader.prototype._loadChildren = function ($parentNode) {
        this.$el.focus()
        $parentNode
            .addClass(this.CLASS.checkClass.menuNodeSelected)
            .siblings()
            .removeClass(this.CLASS.checkClass.menuNodeSelected)
        var $wrap = $parentNode.closest('.' + this.CLASS.menuWrap)
        var data = $parentNode.data('bindData')
        this.$dropdownWrap
            .find('li.' + this.CLASS.checkClass.nodeAnchor)
            .removeClass(this.CLASS.checkClass.nodeAnchor)
        $parentNode.addClass(this.CLASS.checkClass.nodeAnchor)
        if (!data.children) {
            $wrap.nextAll().remove()
            return
        }
        var selectedId = []
        var pathData = this.$el.data('bindPathData')
        if (pathData && pathData.length > 0) {
            selectedId = $.map(pathData, m => {
                return m.value
            })
        }
        var $nextWrap = $wrap.next()
        if (!$nextWrap || $nextWrap.length === 0) {
            $nextWrap = $(`<div class="zd-scrollbar ${this.CLASS.menuWrap}">
                                        <div class="zd-cascader-menu__wrap zd-scrollbar__wrap" id="scrollbar">
                                            <ul class="${this.CLASS.menuList}">
                                            </ul>
                                        </div>
                                    </div>`)
            $nextWrap = $nextWrap.appendTo(this.$dropdownWrap)
        }
        $nextWrap.nextAll().remove()
        var $ul = $nextWrap.find('.' + this.CLASS.menuList).empty()
        $.each(data.children, (i, m) => {
            var $li = $(
                `<li class="${this.CLASS.menuNode} ${m.active &&
                    'in-active-path'}"></li>`
            )
            var $label = $(
                `<span class="${this.CLASS.menuNodeLabel}">${m.label}</span>`
            )
            var $icon = $(`<svg t="1600158452164"
                                        class="icon zd-input__icon zd-icon-arrow-right ${this.CLASS.menuNodePostfix}"
                                        viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1181"
                                        width="200" height="200">
                                        <path
                                            d="M538.434046 617.504916c0 3.687996-1.403976 7.356548-4.211928 10.1645-5.615904 5.615904-14.713097 5.615904-20.329001 0L364.187513 476.931297c-5.615904-5.615904-5.615904-14.713097 0-20.329001 5.615904-5.615904 14.713097-5.615904 20.329001 0l149.705604 150.739143C537.03007 610.148367 538.434046 613.817943 538.434046 617.504916z"
                                            p-id="1182" fill="#515151"></path>
                                        <path
                                            d="M689.172165 466.767819c0 3.687996-1.403976 7.356548-4.211928 10.1645L534.222117 627.670439c-5.615904 5.615904-14.713097 5.615904-20.329001 0-5.615904-5.615904-5.615904-14.713097 0-20.329001L664.631236 456.603319c5.615904-5.615904 14.713097-5.615904 20.329001 0C687.768189 459.411271 689.172165 463.079824 689.172165 466.767819z"
                                            p-id="1183" fill="#515151"></path>
                                    </svg>`)
            $li.append($label).data('bindData', m)
            if (m.children && m.children.length > 0) $li.append($icon)
            else if (selectedId.indexOf(m.value) >= 0) {
                this.$dropdownWrap
                    .find('.' + this.CLASS.checkClass.nodeSelectedIcon)
                    .remove()
                $li.addClass(this.CLASS.checkClass.menuNodeSelected).prepend(
                    $(
                        `<span class="${this.CLASS.checkClass.nodeSelectedIcon}">√</span>`
                    )
                )
            }
            $li.appendTo($ul)
        })
        new PerfectScrollbar('#scrollbar', {
            wheelSpeed: 1,
            wheelPropagation: false
        })
    }
    //销毁
    ZdCascader.prototype.destroy = function () {
        $(this.$el).insertAfter(this.$el_)
        this.$el.remove()
    }
    //获取名称列表
    ZdCascader.prototype.getLabelList = function () {
        var datas = []
        this.options.data.forEach(function (prov) {
            if (prov.children) {
                prov.children.forEach(function (city) {
                    if (city.children) {
                        city.children.forEach(function (area) {
                            datas.push({
                                label: `${prov.label} / ${city.label} / ${area.label}`,
                                labels: [prov.label, city.label, area.label],
                                value: [prov.value, city.value, area.value]
                            })
                        })
                    } else {
                        datas.push({
                            label: `${prov.label} / ${city.label}`,
                            labels: [prov.label, city.label],
                            value: [prov.value, city.value]
                        })
                    }
                })
            } else {
                datas.push({
                    label: prov.label,
                    labels: [prov.label],
                    value: prov.value
                })
            }
        })
        this.labelList = datas
    }
    //搜索
    ZdCascader.prototype.search = function (keyword) {
        if (keyword) keyword = keyword.trim()
        if (!keyword) {
            this.options.keyword = keyword
            this.reload(null, true)
            return
        }
        var keywords = keyword
            .replace(' ', '')
            .replace('/', '')
            .split('')
        var data = this.labelList
            .filter(function (item) {
                item.num = 0
                keywords.forEach(function (key) {
                    if (item.label.includes(key)) item.num++
                })
                if (item.label.includes(keyword)) item.num += 2
                return item.num > (keywords.length == 1 ? 0 : 1)
            })
            .sort(function (a, b) {
                return b.num - a.num
            })
            .slice(0, 10)
        this.reload(data, true)
    }
    //关键词筛选数据（暂不用）
    ZdCascader.prototype.searchData = function (keyword) {
        var data = []
        this.options.data.forEach(function (prov) {
            if (prov.label.indexOf(keyword) >= 0) {
                data.push(prov)
            } else {
                if (prov.children) {
                    var citys = []
                    prov.children.forEach(function (city) {
                        if (city.label.indexOf(keyword) >= 0) {
                            citys.push(city)
                        } else {
                            if (city.children) {
                                var areas = []
                                city.children.forEach(function (area) {
                                    if (area.label.indexOf(keyword) >= 0) {
                                        areas.push(area)
                                    }
                                })
                                if (areas.length > 0) {
                                    citys.push({
                                        value: city.value,
                                        label: city.label,
                                        children: areas
                                    })
                                }
                            }
                        }
                    })
                    if (citys.length > 0) {
                        data.push({
                            label: prov.label,
                            value: prov.value,
                            children: citys
                        })
                    }
                }
            }
        })
    }
    //重新加载下拉数据
    ZdCascader.prototype.reload = function (data, search) {
        data = data || this.options.data
        this.$el.removeData('bindData').removeData('bindPathData')
        if (!search) this.$el.val('')
        this.$dropdownWrap.empty()
        var selectedData = this.$el.data('bindData')
        var $firstWrap = $(`<div class="zd-scrollbar ${this.CLASS.menuWrap}">
                                            <div class="zd-cascader-menu__wrap zd-scrollbar__wrap">
                                                <ul class="${this.CLASS.menuList}">
                                                </ul>
                                            </div>
                                        </div>`)
        var $ul = $firstWrap.find('.' + this.CLASS.menuList)
        $.each(data, (i, m) => {
            var $li = $(
                `<li class="${this.CLASS.menuNode} ${m.active &&
                    'in-active-path'}"></li>`
            )
            var $label = $(
                `<span class="${this.CLASS.menuNodeLabel}">${m.label}</span>`
            )
            var $icon = $(`<svg t="1600158452164"
                                        class="icon zd-input__icon zd-icon-arrow-right ${this.CLASS.menuNodePostfix}"
                                        viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1181"
                                        width="200" height="200">
                                        <path
                                            d="M538.434046 617.504916c0 3.687996-1.403976 7.356548-4.211928 10.1645-5.615904 5.615904-14.713097 5.615904-20.329001 0L364.187513 476.931297c-5.615904-5.615904-5.615904-14.713097 0-20.329001 5.615904-5.615904 14.713097-5.615904 20.329001 0l149.705604 150.739143C537.03007 610.148367 538.434046 613.817943 538.434046 617.504916z"
                                            p-id="1182" fill="#515151"></path>
                                        <path
                                            d="M689.172165 466.767819c0 3.687996-1.403976 7.356548-4.211928 10.1645L534.222117 627.670439c-5.615904 5.615904-14.713097 5.615904-20.329001 0-5.615904-5.615904-5.615904-14.713097 0-20.329001L664.631236 456.603319c5.615904-5.615904 14.713097-5.615904 20.329001 0C687.768189 459.411271 689.172165 463.079824 689.172165 466.767819z"
                                            p-id="1183" fill="#515151"></path>
                                    </svg>`)
            $li.append($label).data('bindData', m)
            if (m.children && m.children.length > 0) $li.append($icon)
            else if (selectedData && m.value == selectedData.value) {
                this.$dropdownWrap
                    .find('.' + this.CLASS.checkClass.nodeSelectedIcon)
                    .remove()
                $li.prepend(
                    $(
                        `<span class="${this.CLASS.checkClass.nodeSelectedIcon}">√</span>`
                    )
                )
            }
            $ul.append($li)
        })
        this.$dropdownWrap
            .find('li.' + this.CLASS.checkClass.nodeAnchor)
            .removeClass(this.CLASS.checkClass.nodeAnchor)
        this.$dropdownWrap
            .append($firstWrap)
            .find(this.CLASS.menuNode)
            .eq(0)
            .focus()
            .addClass(this.CLASS.checkClass.nodeAnchor)
    }
    ZdCascader.prototype._keyup = function (event) {
        var keycode = event.which
        switch (keycode) {
            case _keyCodes.DOWN:
                this._movedown()
                break
            case _keyCodes.UP:
                this._moveup()
                break
            case _keyCodes.LEFT:
                this._moveleft()
                break
            case _keyCodes.RIGHT:
                this._moveright()
                break
            case _keyCodes.ENTER:
                this._keyenter()
                break
            case _keyCodes.ESC:
                this._keyesc()
                break
            default:
                break
        }
    }

    ZdCascader.prototype._movedown = function () {
        var $selected
        if (!this.$container.hasClass(this.CLASS.checkClass.wrapFocus)) {
            this.$container.trigger('click')
            return
        }
        $selected = this.$dropdownWrap.find(
            '.' + this.CLASS.menuNode + '.' + this.CLASS.checkClass.nodeAnchor
        )
        if ($selected.length === 0)
            $selected = this.$dropdownWrap
                .find('.' + this.CLASS.menuWrap)
                .eq(0)
                .find('.' + this.CLASS.menuNode)
                .eq(0)
                .addClass(this.CLASS.checkClass.nodeAnchor)
        else if ($selected.next().length > 0)
            $selected = $selected
                .removeClass(this.CLASS.checkClass.nodeAnchor)
                .next()
                .addClass(this.CLASS.checkClass.nodeAnchor)
        this._loadChildren($selected)
    }
    ZdCascader.prototype._moveup = function () {
        if (!this.$container.hasClass(this.CLASS.checkClass.wrapFocus)) return
        var $selected = this.$dropdownWrap.find(
            '.' + this.CLASS.menuNode + '.' + this.CLASS.checkClass.nodeAnchor
        )
        if ($selected.length === 0) return

        if ($selected.prev().length > 0)
            $selected = $selected
                .removeClass(this.CLASS.checkClass.nodeAnchor)
                .prev()
                .addClass(this.CLASS.checkClass.nodeAnchor)
        this._loadChildren($selected)
    }
    ZdCascader.prototype._moveleft = function () {
        if (!this.$container.hasClass(this.CLASS.checkClass.wrapFocus)) return
        var $selected = this.$dropdownWrap.find(
            '.' + this.CLASS.menuNode + '.' + this.CLASS.checkClass.nodeAnchor
        )
        if ($selected.length === 0) return

        var $leftWrap = $selected.closest('.' + this.CLASS.menuWrap).prev()
        if ($leftWrap.length === 0) return

        $selected.removeClass(this.CLASS.checkClass.nodeAnchor)
        $selected =
            $leftWrap.find('li.' + this.CLASS.checkClass.menuNodeSelected)
                .length > 0
                ? $leftWrap
                      .find('li.' + this.CLASS.checkClass.menuNodeSelected)
                      .eq(0)
                : $leftWrap.find('li' + this.CLASS.menuNode).eq(0)
        $selected.addClass(this.CLASS.checkClass.nodeAnchor)
        this._loadChildren($selected)
    }
    ZdCascader.prototype._moveright = function () {
        if (!this.$container.hasClass(this.CLASS.checkClass.wrapFocus)) return
        var $selected = this.$dropdownWrap.find(
            '.' + this.CLASS.menuNode + '.' + this.CLASS.checkClass.nodeAnchor
        )
        if ($selected.length === 0) return

        var $rightWrap = $selected.closest('.' + this.CLASS.menuWrap).next()
        if ($rightWrap.length === 0) return

        $selected.removeClass(this.CLASS.checkClass.nodeAnchor)
        $selected = $rightWrap
            .find('li.' + this.CLASS.menuNode)
            .eq(0)
            .addClass(this.CLASS.checkClass.nodeAnchor)
        this._loadChildren($selected)
    }
    ZdCascader.prototype._keyenter = function () {
        if (!this.$container.hasClass(this.CLASS.checkClass.wrapFocus)) return
        var $selected = this.$dropdownWrap.find(
            '.' + this.CLASS.menuNode + '.' + this.CLASS.checkClass.nodeAnchor
        )
        if ($selected.length === 0) return

        var $rightWrap = $selected.closest('.' + this.CLASS.menuWrap).next()
        if ($rightWrap.length !== 0) return

        $selected.trigger('click')
    }
    ZdCascader.prototype._keyesc = function () {
        if (!this.$container.hasClass(this.CLASS.checkClass.wrapFocus)) return
        this.$container.removeClass(this.CLASS.checkClass.wrapFocus)
        this.$el.focus()
    }

    $.fn.zdCascader = function (option) {
        var value,
            args = Array.prototype.slice.call(arguments, 1)

        this.each(function () {
            var $this = $(this),
                data = $this.data('zdCascader'),
                options = $.extend(
                    {},
                    ZdCascader.DEFAULTS,
                    $this.data(),
                    typeof option === 'object' && option
                )

            if (typeof option === 'string') {
                if ($.inArray(option, ZdCascader.METHODS) < 0) {
                    throw new Error('Unknown method: ' + option)
                }

                if (!data) {
                    return
                }

                value = data[option].apply(data, args)

                if (option === 'destroy') {
                    $this.removeData('zdCascader')
                }
            }

            if (!data) {
                $this.data('zdCascader', (data = new ZdCascader(this, options)))
            }
        })

        return typeof value === 'undefined' ? this : value
    }
})(jQuery)

