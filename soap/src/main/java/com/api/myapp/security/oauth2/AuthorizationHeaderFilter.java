package com.api.myapp.security.oauth2;

import static org.springframework.cloud.netflix.zuul.filters.support.FilterConstants.PRE_TYPE;

import com.api.myapp.client.TokenRelayRequestInterceptor;
import com.netflix.zuul.ZuulFilter;
import com.netflix.zuul.context.RequestContext;
import java.util.Optional;
import org.springframework.core.Ordered;

public class AuthorizationHeaderFilter extends ZuulFilter {
    private final AuthorizationHeaderUtil headerUtil;

    public AuthorizationHeaderFilter(AuthorizationHeaderUtil headerUtil) {
        this.headerUtil = headerUtil;
    }

    @Override
    public String filterType() {
        return PRE_TYPE;
    }

    @Override
    public int filterOrder() {
        return Ordered.LOWEST_PRECEDENCE;
    }

    @Override
    public boolean shouldFilter() {
        return true;
    }

    @Override
    public Object run() {
        RequestContext ctx = RequestContext.getCurrentContext();
        Optional<String> authorizationHeader = headerUtil.getAuthorizationHeader();
        authorizationHeader.ifPresent(s -> ctx.addZuulRequestHeader(TokenRelayRequestInterceptor.AUTHORIZATION, s));
        return null;
    }
}
